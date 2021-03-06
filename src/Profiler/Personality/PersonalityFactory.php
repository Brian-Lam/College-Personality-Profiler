<?php
namespace Profiler\Personality;

use Profiler\Personality\Personality;

use Profiler\Fetcher\JSONFetcher;

use Profiler\Map\Map;
use Profiler\Instagram\Instagram;
use Profiler\Facebook\FacebookCoverPhotoGrabber;
use Profiler\YikYak\YikYakGrabber;

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
		$args['ACT'] = ($t[0] + $t[1]) / 2;
		$args['SATReading'] = ($t[2] + $t[3]) / 2;
		$args['SATMath'] = ($t[4] + $t[5]) / 2;
		$args['SATWriting'] = ($t[6] + $t[7]) / 2;


		$instagram = new Instagram($map->getLongitude(), $map->getLatitude(), $name);
		$args['instagramUrl'] = $instagram->getUrl();

		$coverPhoto = new FacebookCoverPhotoGrabber("93768131177");
		$coverphotourl = $coverPhoto->run();
		$args['coverPhoto'] = $coverphotourl;

		$yaks = new YikYakGrabber($map->getLatitude(),$map->getLongitude(),10);
		$args['yaks'] = $yaks->run();

		$personality = new Personality($args);
		return $personality;
	}
}
?>