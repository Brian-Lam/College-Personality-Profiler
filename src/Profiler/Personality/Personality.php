<?php
namespace Profiler\Personality;
// The Personality class is never by itself instantiated, instead we
// create it using a PersonalityFactory

// It has accessor methods for all the data we need about people at a University.

class Personality{
	protected $args;

	public function __construct($args) {
		$this->args=$args;
		$this->debug();
	}

	public function debug() {
		echo($this->args);
	}
}