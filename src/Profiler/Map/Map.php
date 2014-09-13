<?php
namespace Profiler\Map;

use Profiler\Fetcher\JSONFetcher;

class Map{
	public function __construct($placename) {
		$base = "https://maps.googleapis.com/maps/api/geocode/json";
		$args = array();
		$args["address"] = $placename;
		$fetcher = new JSONFetcher($base, $args);
		$result = $fetcher->run();
		echo($result);
	}
}
?>