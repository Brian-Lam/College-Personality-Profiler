<?php
namespace Profiler\Fetcher;

use Exception;

// An HTML fetcher class, made for APIs
// Basically taken from citelao's Spotifious.
// Thanks Jeff Johns <http://phpfunk.me/> and Robin Enhorn <https://github.com/enhorn/>
class Fetcher {
	protected $url;
	protected $args;
	protected $post;

	// Create a new Fetcher!
	// $url => the base url to search ("https://google.com/")
	// $args => array of args (["name" => "Wash U", "other" => "Moo"])
	// $post => boolean, whether to use post (or get, if false)
	public function __construct($url, $args = array(), $post = false) {
		$this->url = $url;

		// If it's a post request, create a sanitized array and pass.
		// Otherwise, concatenate the arguments to the URL.
		if($this->post) {
			$this->args = array();
			foreach($args as $key => $value) {
				$saniKey = urlencode($key);
				$saniValue = urlencode($value);

				$this->args[$saniKey] = $saniValue;
			}
		} else {
			if(sizeof($args) > 0) {
				$this->args = "?";
				foreach($args as $key => $value) {
					$saniKey = urlencode($key);
					$saniValue = urlencode($value);

					$this->args .= $saniKey . '=' . $saniValue . '&';
				}
				rtrim($this->args, '&');

				$this->url .= $this->args;
			}
		}

		
	}

	public function run() {
		$ch = curl_init($this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);

		// If post, include POST variables.
		if($this->post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->args);
		}

		// SSL
		// TODO this is insecure— hacky
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		// curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/static/cert/");

		$page    = curl_exec($ch);
		$info    = curl_getinfo($ch);
		$error   = curl_errno($ch);
		curl_close($ch);

		if($info['http_code'] != '200') {
		 	if (!$error) {
		 		throw new Exception("Could not access '$this->url'.");
		 	}

	 		throw new Exception("fetch() failed; error code: " . $error);
		 }

		return $page;
	}
}