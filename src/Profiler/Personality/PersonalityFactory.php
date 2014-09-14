<?php
namespace Profiler\Personality;

use Profiler\Personality\Personality;

use Profiler\Fetcher\JSONFetcher;

use Profiler\Map\Map;
use Profiler\Instagram\Instagram;
// The Profiler takes a school name and creates a Profile object
// It grabs all the data required and builds a very nice and pretty object for the front-end.


// $person =  PersonalityFactory::personalityFromSchoolName("wash u");
class PersonalityFactory {

	public static function createProfileBySchoolName($name) {
		$args = array();

		$map = new Map($name);
		$args['longitude'] = $map->getLongitude();
		$args['latitude'] = $map->getLatitude();

		$name = preg_replace("/ /", "", $name);
		$name = preg_replace("/\./", "", $name);
		$name = strtolower($name);

		// get percentage male
		$fileName = "/Users/morganredding/Desktop/Hackathon/College-Personality-Profiler/data/".$name."/gender.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,)]/', '', $t);
		$t = explode(',', $t);
		$args['percentMale'] = $t[0];

		// get ethnicities
		$fileName = "/Users/morganredding/Desktop/Hackathon/College-Personality-Profiler/data/".$name."/ethnicities.json";
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
		$fileName = "/Users/morganredding/Desktop/Hackathon/College-Personality-Profiler/data/".$name."/population.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,|\.)]/', '', $t);
		$t = explode(',', $t);
		$args['Total'] = $t[0];
		$args['Undergraduate'] = $t[1];

		// get residency
		$fileName = "/Users/morganredding/Desktop/Hackathon/College-Personality-Profiler/data/".$name."/residency.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,|\.)]/', '', $t);
		$t = explode(',', $t);
		$args['InState'] = $t[0];
		$args['OutState'] = $t[1];
		$args['Foreign'] = $t[2];

		// get testScores
		$fileName = "/Users/morganredding/Desktop/Hackathon/College-Personality-Profiler/data/".$name."/academics/testScores.json";
		$doc = fopen($fileName,"r");
		$t = fread($doc, filesize($fileName));
		fclose($doc);
		$t = preg_replace('/[^(\d+|,|\.)]/', '', $t);
		$t = explode(',', $t);
		$args['ACT'] = ($t[0] + $t[1]) / 2;
		$args['SATReading'] = ($t[2] + $t[3]) / 2;
		$args['SATMath'] = ($t[4] + $t[5]) / 2;
		$args['SATWriting'] = ($t[6] + $t[7]) / 2;


		$instagram = new Instagram($map->getLongitude(), $map->getLatitude());
		$args['instagramUrl'] = $instagram->getUrl();

		$personality = new Personality($args);
		return $personality;
	}
}
?>