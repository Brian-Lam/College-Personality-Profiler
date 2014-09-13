<?php
namespace Profiler\Instagram;

use Profiler\Fetcher\JSONFetcher;

class Instagram{
	protected $image_url;

	public function __construct($lng, $lat){
		$distance = "400";
		$base_url = "https://api.instagram.com/v1/media/search?lat=";
		$url = $base_url . $lat . "&lng=" .$lng . "&client_id=" . $client_id;

		$fetcher = new JSONFetcher($url);
		$result = $fetcher->run();
		$image_url = $result->data[0]->images->standard_resolution->url;

		$this->image_url = $image_url;
	}

	public function getUrl(){
		return $this->image_url;
	}
}
?>