<?php
namespace Profiler\Personality;

use Profiler\Personality\Personality;

use Profiler\Fetcher\JSONFetcher;

use Profiler\Map\Map;
use Profiler\Instagram\Instagram;
use Profiler\Facebook\FacebookCoverPhotoGrabber;
use Profiler\YikYak\YikYakGrabber;
use Profiler\Analyzer\HappinessAnalyzer;

// The Profiler takes a school name and creates a Profile object
// It grabs all the data required and builds a very nice and pretty object for the front-end.


// $person =  PersonalityFactory::personalityFromSchoolName("wash u");
class PersonalityFactory {

	public static function createProfileBySchoolName($name) {
		$args = array();

		$map = new Map($name);
		$args['longitude'] = $map->getLongitude();
		$args['latitude'] = $map->getLatitude();

		$parsedName = preg_replace("/ /", "", $name);
		$parsedName = preg_replace("/\./", "", $parsedName);
		$parsedName = strtolower($parsedName);

		// get percentage male
		$fileName = getcwd() . "/data/".$parsedName."/gender.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,)]/', '', $t);
		$t = explode(',', $t);
		$args['percentMale'] = $t[0];

		// get ethnicities
		$fileName = getcwd() . "/data/".$parsedName."/ethnicities.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,|\.)]/', '', $t);
		$t = explode(',', $t);
		$args['Caucasian'] = $t[0];
		$args['African American'] = $t[1];
		$args['Hispanic'] = $t[2];
		$args["Asian"] = $t[3];
		$args["Native Hawaiin/Pacific Islander"] = $t[4];
		$args["Other"] = $t[5];

		// diversity
		rsort($t);
		$args["Diversity"] = ($t[0] + $t[1] * 2 + $t[2] * 4) / ($t[0] + $t[1] + $t[2]);
		$args["Diversity"] = ($args["Diversity"] - 3 / 7) * (21 / 40);

		// get population
		$fileName = getcwd() . "/data/".$parsedName."/population.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,|\.)]/', '', $t);
		$t = explode(',', $t);
		$args['Total'] = $t[0];
		$args['Undergraduate'] = $t[1];

		// get residency
		$fileName = getcwd() . "/data/".$parsedName."/residency.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,|\.)]/', '', $t);
		$t = explode(',', $t);
		$args['InState'] = $t[0];
		$args['OutState'] = $t[1];
		$args['Foreign'] = $t[2];

		// get testScores
		$fileName = getcwd() . "/data/".$parsedName."/academics/testScores.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,|\.)]/', '', $t);
		$t = explode(',', $t);
		$args['ACT'] = intval(($t[0] + $t[1]) / 2);
		$args['SATReading'] = intval(($t[2] + $t[3]) / 2);
		$args['SATMath'] = intval(($t[4] + $t[5]) / 2);
		$args['SATWriting'] = intval(($t[6] + $t[7]) / 2);

		//get Facebook ID and nickname
		$fileName = getcwd() . "/data/" . $parsedName . "/name.json";
		$namefile = file_get_contents($fileName);
		$fbfile = json_decode($namefile);
		$args['fbid'] = $fbfile->fbid;
		$args['nickname'] = $fbfile->name;

		//get weather
		$fileName = getcwd() . "/data/" . $parsedName . "/weather.json";
		$weatherfile = file_get_contents($fileName);
		$weather = json_decode($weatherfile);
		$args['snowfall'] = $weather->weather->snowfall;
		$args['rainfall'] = $weather->weather->rainfall;
		$args['avgtemp'] = $weather->weather->avgtemperature;

		//get additional info
		$fileName = getcwd() . "/data/" . $parsedName . "/additional.json";
		$additionalfile = file_get_contents($fileName);
		$addfile = json_decode($additionalfile);
		$args['frat'] = $addfile->percent_fraternity;
		$args['soro'] = $addfile->percent_sorority;


		$instagram = new Instagram($map->getLongitude(), $map->getLatitude(), $name);
		$args['instagramUrl'] = $instagram->getUrl();

		$coverPhoto = new FacebookCoverPhotoGrabber($args['fbid']);
		$coverphotourl = $coverPhoto->run();
		$args['coverPhoto'] = $coverphotourl;

		$yaks = new YikYakGrabber($map->getLatitude(),$map->getLongitude(),10);
		$args['yaks'] = $yaks->run();
		echo $args['yaks'];

		$happiness = new HappinessAnalyzer($args['yaks']);
		// $args['happiness'] = $happiness->run();
		

		$personality = new Personality($args);
		return $personality;
	}
}
?>