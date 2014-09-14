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

	public function getLongitude() {
		return $this->args["longitude"];
	}

	public function getLatitude() {
		return $this->args["latitude"];
	}

	public function getInstagramUrl() {
		return $this->args['instagramUrl'];
	}

	public function getPercentMale() {
		return $this->args["percentMale"];
	}

	public function getEthnicities() {
		$list = array();
		array_push($list, $this->args["Caucasian"]);
		array_push($list, $this->args["African American"]);
		array_push($list, $this->args["Hispanic"]);
		array_push($list, $this->args["Asian"]);
		array_push($list, $this->args["Native Hawaiin/Pacific Islander"]);
		array_push($list, $this->args["Other"]);
		return $list;
	}

	public function getResidency() {
		return [$this->args["InState"], $this->args["OutState"], $this->args["Foreign"]];
	}

	public function getDiversity() {
		return $this->args["Diversity"];
	}

	public function getUndergrads() {
		return $this->args["Undergraduate"];
	}

	public function getACT() {
		return $this->args["ACT"];
	}

	public function getSAT() {
		return [$this->args["SATReading"], $this->args["SATMath"], $this->args["SATWriting"]];
	}

}