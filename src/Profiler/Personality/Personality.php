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

	public function getCoverPhotoUrl(){
		return $this->args['coverPhoto'];
	}

	public function getYaks(){
		return $this->args['yaks'];
	}

	public function getNickname(){
		return $this->args['nickname'][1];
	}

	public function getFrat(){
		return $this->args['frat'];
	}

	public function getSoro(){
		return $this->args['soro'];
	}

	public function getTempFluctuation(){
		return max($this->args['avgtemp'])-min($this->args['avgtemp']);
	}

	public function rainQuantifier(){
		$rain = array_sum($this->args['rainfall']);
		$ton = 35;
		$occasionally = 20;
		$bit = 10;

		if($rain>$ton){
			return "a ton";
		}
		elseif($rain>$occasionally){
			return "occasionally";
		}
		elseif($rain>$bit){
			return "a bit";
		}
		else{
			return "almost never";
		}
	}

	public function snowQuantifier(){
		$snow = array_sum($this->args['snowfall']);
		$ton = 30;
		$occasionally = 20;
		$bit = 10;

		if($snow>$ton){
			return "a ton";
		}
		elseif($snow>$occasionally){
			return "occasionally";
		}
		elseif($snow>$bit){
			return "a bit";
		}
		else{
			return "almost never";
		}
	}

	public function diversityPhrase(){
		$diversity = $this->getDiversity();
		if($diversity>0.9){
			return "We have an extremely diverse campus.";
		}
		elseif($diversity>0.8){
			return "We have a pretty diverse campus.";
		}
		elseif($diversity>0.7){
			return "Campus is fairly diverse.";
		}
		elseif($diversity>0.6){
			return "We don't have a very diverse campus.";
		}
		else{
			return "Our campus is not at all diverse.";
		}
	}

	public function getAddress(){
		return $this->args['city'] . ", " . $this->args['state'];
	}

	public function snowPhrase(){
		$snow = array_sum($this->args['snowfall']);
		if($snow>48){
			return "We get completely blanketed with snow.";
		}
		elseif($snow>30){
			return "Wear snow boots!";
		}
		elseif($snow>12){
			return "Get ready to build snowmen!";
		}
		elseif($snow>6){
			return "Every once in a while we have a snow day.";
		}
		else{
			return "Prepare for a sunny winter!";
		}
	}

	public function mostFriends(){
		$c = $this->args['Caucasian'];
		$aa = $this->args['African American'];
		$h = $this->args['Hispanic'];
		$a = $this->args["Asian"];
		$n = $this->args["Native Hawaiin/Pacific Islander"];
		$most = max([$c,$aa,$h,$a,$n]);
		if($most==$c){
			return "Caucasian";
		}
		elseif($most==$aa){
			return "African American";
		}
		elseif($most==$h){
			return "Hispanic";
		}
		elseif($most==$a){
			return "Asian";
		}
		else{
			return "Native Hawaiin/Pacific Islander";
		}
	}

	public function getForeign(){
		return $this->args['Foreign'];
	}
}