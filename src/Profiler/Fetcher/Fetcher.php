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

		$page    = curl_exec($ch);
		$info    = curl_getinfo($ch);
		curl_close($ch);

		if($info['http_code'] != '200') {
		 	if ($info['http_code'] == '0') {
		 		throw new Exception("Could not access '$this->url'.");
		 	}

	 		throw new Exception("fetch() failed; error code: " . $info['http_code']);
		 }

		return $page;
	}
}