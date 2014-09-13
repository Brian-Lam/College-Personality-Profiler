<?php
namespace Profiler\Personality;

use Profiler\Personality\Personality;
use Profiler\Map\Map;
// The Profiler takes a school name and creates a Profile object
// It grabs all the data required and builds a very nice and pretty object for the front-end.


// $person =  PersonalityFactory::personalityFromSchoolName("wash u");
class PersonalityFactory {
	
	public static function createProfileBySchoolName($name) {
		$args = array();

		$map = new Map($name);
		$args['longitude'] = $map->getLongitude();
		$args['latitude'] = $map->getLatitude();
		$personality = new Personality($args);
		return $personality;
	}
}
?>