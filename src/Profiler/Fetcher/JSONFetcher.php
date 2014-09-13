<?php
namespace Profiler\Fetcher;

use Exception;
use Profiler\Fetcher\Fetcher;

// A JSON fetcher class, made for APIs
// Basically taken from citelao's Spotifious.
class JSONFetcher {
	protected $fetcher;

	// Create a new Fetcher!
	// $url => the base url to search ("https://google.com/")
	// $args => array of args (["name" => "Wash U", "other" => "Moo"])
	// $post => boolean, whether to use post (or get, if false)
	public function __construct($url, $args = array(), $post = false) {
		$this->fetcher = new Fetcher($url, $args, $post);
	}

	public function run() {
		$json = $this->fetcher->run();

		if(empty($json))
			throw new Exception("No JSON returned from '" . $url . "'");

		$json = json_decode($json);

		if($json == null)
			throw new Exception("JSON error: " . json_last_error());
		return $json;
	}
}