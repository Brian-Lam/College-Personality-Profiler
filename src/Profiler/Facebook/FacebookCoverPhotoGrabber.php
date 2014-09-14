<?php
namespace Profiler\Facebook
class FacebookCoverPhotoGrabber {
	protected $fbid;

	public function __construct($fbid) {
		this->$fbid=$fbid;
	}

	public function run() {
		$baseurl = "https://graph.facebook.com/";
		$schoolurl = $baseurl . $fbid;
		$schoolpage = file_get_contents($schoolurl);
		$cover_id_start = strstr($schoolpage,"cover_id");
		$cover_id_line = strstr($cover_id_start,",",true);
		$cover_id = substr($cover_id_line, 11,-1);
		$coverurl = $baseurl . $cover_id;
		$coverpage = file_get_contents($coverurl);
		$source_start = strstr($coverpage,"source");
		$source_line = strstr($source_start,",",true);
		$source = substr($source_line, 9,-1);
		return stripcslashes($source);
	}
}
?>