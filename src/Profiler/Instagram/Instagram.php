<?php
namespace Profiler\Instagram;

use Profiler\Fetcher\JSONFetcher;
use Profiler\Foursquare\Foursquare;

class Instagram {
	protected $image_urls;

	public function __construct($lng, $lat, $school, $num_photos){
		$client_id = "874cce6718bf4b2db62677a9cc754a43";
		$distance = "700";

		$foursquare = new Foursquare($lng, $lat, $school);

		$locationArgs = array(
			// 'lat' => $lat,
			// 'lng' => $lng,
			// 'distance' => $distance,
			'foursquare_v2_id' => $foursquare->getID(),
			'client_id' => $client_id
		);

		$locationSearchBase = "https://api.instagram.com/v1/locations/search";

		$locationFetcher = new JSONFetcher($locationSearchBase, $locationArgs);
		$locationResults = $locationFetcher->run();

		$id = $locationResults->data[0]->id;
		$base = "https://api.instagram.com/v1/locations/$id/media/recent";
		$args = array('client_id' => $client_id);

		$fetcher = new JSONFetcher($base, $args);
		$result = $fetcher->run();

		$image_urls = array();
		$photos = $result->data;
		$counter = 0;
		foreach ($photos as $photo) {
			array_push($image_urls,$photo->images->standard_resolution->url);
			$counter++;
			if($counter>=$num_photos){
				break;
			}
		}
		$this->image_urls = $image_urls;
	}

	public function getUrl(){
		return $this->image_urls;
	}
}
?>