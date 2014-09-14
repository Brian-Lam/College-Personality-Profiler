<?php
namespace Profiler\Personality;

use Profiler\Personality\Personality;

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