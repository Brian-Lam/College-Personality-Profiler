<?php
namespace Profiler\YikYak;

use Profiler\Fetcher\JSONFetcher;

class YikYak{
	protected $lng;
	protected $lat;
	protected $user_id;

	//Ported from https://github.com/joseph346/pyak/blob/master/pyak.py
	public function __construct($lng, $lat){
		// $result = exec("python example.py $lng $lat 2>&1");
		// echo $result;
		exec("python example.py 2>&1", $output);
		print_r($output);
	}

}
?>