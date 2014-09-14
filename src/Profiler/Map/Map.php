<?php
namespace Profiler\Map;

use Profiler\Fetcher\JSONFetcher;

class Map{
	protected $lat;
	protected $lng;

	public function __construct($placename) {
		$base = "https://maps.googleapis.com/maps/api/geocode/json";
		$args = array();
		$args["address"] = $placename;
		$fetcher = new JSONFetcher($base, $args);
		$result = $fetcher->run();

		$this->lat = $result->results[0]->geometry->bounds->northeast->lat;
		$this->lng = $result->results[0]->geometry->bounds->northeast->lng;
	}

	public function getLongitude() {
		return $this->lng;
	}

	public function getLatitude() {
		return $this->lat;
	}
}
?>