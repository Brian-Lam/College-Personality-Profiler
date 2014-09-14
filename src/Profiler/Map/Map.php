<?php
namespace Profiler\Map;

use Profiler\Fetcher\JSONFetcher;

class Map{
	protected $lat;
	protected $lng;
	protected $city;
	protected $state;
	protected $zipcode;

	public function __construct($placename) {
		$base = "https://maps.googleapis.com/maps/api/geocode/json";
		$args = array();
		$args["address"] = $placename;
		$fetcher = new JSONFetcher($base, $args);
		$result = $fetcher->run();

		$this->lat = $result->results[0]->geometry->location->lat;
		$this->lng = $result->results[0]->geometry->location->lng;

		for($i = 0; $i < count($result->results[0]->address_components); $i++) {
			if($result->results[0]->address_components[$i]->types[0] == "locality") {
				$this->city = $result->results[0]->address_components[$i]->long_name;
			}
			elseif($result->results[0]->address_components[$i]->types[0] == "administrative_area_level_1") {
				$this->state = $result->results[0]->address_components[$i]->long_name;
			}
			elseif($result->results[0]->address_components[$i]->types[0] == "postal_code") {
				$this->zipcode = $result->results[0]->address_components[$i]->long_name;
			}
		}
	}

	public function getLongitude() {
		return $this->lng;
	}

	public function getLatitude() {
		return $this->lat;
	}

	public function getCity() {
		return $this->city;
	}

	public function getState() {
		return $this->state;
	}
}
?>