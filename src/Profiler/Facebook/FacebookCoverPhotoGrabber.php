<?php
namespace Profiler\Facebook;

use Profiler\Fetcher\JSONFetcher;

class FacebookCoverPhotoGrabber {
	protected $fbid;

	public function __construct($fbid) {
		$this->fbid=$fbid;
	}

	public function run() {
		$baseurl = "https://graph.facebook.com/";
		$schoolurl = $baseurl . $this->fbid;
		$schoolpage = file_get_contents($schoolurl);
		$decodedFile = json_decode($schoolpage);
		$source = $decodedFile->cover->source;
		return stripcslashes($source);
	}
}
?>