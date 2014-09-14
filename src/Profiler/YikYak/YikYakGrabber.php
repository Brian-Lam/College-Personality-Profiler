<?php
namespace Profiler\YikYak;
class YikYakGrabber {
	protected $lat;
	protected $lng;

	public function __construct($lat, $lng) {
		$this->lat = $lat;
		$this->lng = $lng;
	}

	public function run() {
		$command = escapeshellcmd('python src/Profiler/YikYak/example.py');
		$output = shell_exec($command);
		echo $output;
	}
}
?>