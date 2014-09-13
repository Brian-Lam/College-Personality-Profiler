<?php
namespace Profiler\Foursquare;

use Profiler\Fetcher\JSONFetcher;

class Foursquare {
	protected $id;

	public function __construct($lng, $lat, $school) {
		$url = 'https://api.foursquare.com/v2/venues/search';

		// Plz don't hack me :)
		$client_id = "GI4EIXWJAYECZ0YD1DVOFCACRUHIAJA2K4MLTSCNF5QHBANC";
		$client_secret = "24SFWBOE2LK4MC3ITD3JVZEX4VPKIV3N3IM4QO0WP4LJ0HND";

		$args = array(
			'v' => 20130815,
			'client_id' => $client_id,
			'client_secret' => $client_secret,
			'll' => $lat . ',' . $lng,
			'query' => $school
		);

		$fetcher = new JSONFetcher($url, $args);
		$result = $fetcher->run();

		$this->id = $result->response->venues[0]->id;
	}

	public function getID() {
		return $this->id;
	}
}