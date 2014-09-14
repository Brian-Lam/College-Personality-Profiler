<?php
namespace Profiler\YikYak;
class YikYakGrabber {
	protected $lat;
	protected $lng;
	protected $number_yaks;

	public function __construct($lat, $lng, $number_yaks) {
		$this->lat = $lat;
		$this->lng = $lng;
		$this->number_yaks = $number_yaks;
	}

	public function run() {
		$command = escapeshellcmd('python src/Profiler/YikYak/example.py ' . $this->lat . " " . $this->lng . " " . $this->number_yaks);
		$output = shell_exec($command);
		echo $output;
	}
}
?>