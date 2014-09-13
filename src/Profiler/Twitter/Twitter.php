<?php
namespace Profiler\Twitter;

class Twitter {
	public function __construct($lng, $lat) {
		require_once($_SERVER['DOCUMENT_ROOT'] . "/twitteroauth-master/connect.php");
		require_once($_SERVER['DOCUMENT_ROOT'] . "/twitteroauth-master/twitteroauth/twitteroauth.php");

		function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
		  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
		  return $connection;
		}
		 
		$connection = getConnectionWithAccessToken("53207076-VqragtGcaPWoldCNrfbnwwWG4dUnP0BbeKcW4xt8m", "OdeBMzodirvxoDrgkKJxNvkEBeB87TUCkamvMpqyULsgq");
		$content = $connection->get("https://api.twitter.com/1.1/geo/search.json?accuracy=3000&lat=38.6480&long=-90.3050");
		$place_id = $content->result->places[0]->id;
		
		$base_url = "https://twitter.com/search?q=place%3A" . $place_id;
		echo $base_url;
	}
}
?>