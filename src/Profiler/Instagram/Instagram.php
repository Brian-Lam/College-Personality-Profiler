<?php
namespace Profiler\Instagram;

use Profiler\Fetcher\JSONFetcher;

class Instagram{
	protected $image_url;

	public function __construct($lng, $lat){
		$client_id = "874cce6718bf4b2db62677a9cc754a43";
		$distance = "200";

		$args = array(
			'lat' => $lat,
			'lng' => $lng,
			'client_id' => $client_id
		);

		$base = "https://api.instagram.com/v1/media/search";

		$fetcher = new JSONFetcher($base, $args);
		$result = $fetcher->run();

		$image_url = $result->data[0]->images->standard_resolution->url;
		$this->image_url = $image_url;
	}

	public function getUrl(){
		return $this->image_url;
	}
}
?>