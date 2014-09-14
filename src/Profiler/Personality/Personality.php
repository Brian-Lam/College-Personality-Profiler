<?php
namespace Profiler\Personality;
use Profiler\Instagram\Instagram;
// The Personality class is never by itself instantiated, instead we
// create it using a PersonalityFactory

// It has accessor methods for all the data we need about people at a University.

class Personality{
	protected $args;
	protected $instagramUrl;

	public function __construct($args) {
		$this->args=$args;
		//$this->debug();
	}

	public function debug() {
		print_r($this->args);
	}

	public function getLongitude(){
		return $this->args["longitude"];
	}

	public function getLatitude(){
		return $this->args["latitude"];
	}

	public function getInstagramUrls(){
		return $this->args['instagramUrls'];
	}

}