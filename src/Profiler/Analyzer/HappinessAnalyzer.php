//sentiment analyzis from Alex Davies: http://alexdavies.net/twitter-sentiment-analysis/

<?php
namespace Profiler\Analyzer;
class HappinessAnalyzer{
	protected $phrase;

	class Word {
		public $text = "";
		public $happy = 0;
		public $sad = 0;
		function __construct($txt, $happy, $sad) {
       		$this->text = $txt;
       		$this->happy = $happy;
       		$this->sad = $sad;
   		}
   		function getText() {
   			return $this->text;
   		}
	}

	public function __construct($phrase) {
		$this->phrase = str_replace("\n"," ",$phrase);
	}

	function getHappiness($words, $inputText) {
		$text = strtolower($inputText);
		$split = explode(" ", $text);
		$happiness = 0;
		$sadness = 0;
		foreach ($split as $word) {
			foreach ($words as $w){
				if($word == $w->getText()) {
					$happiness += $w->happy;
					$sadness += $w->sad;
				}
			}
		}
		return 1 / (pow(2.718281828, $sadness - $happiness) + 1);
	}

	function getWordList(){
		$words = array();
		$doc = explode("\n",file_get_contents("sentiment_list.csv"));
		foreach ($doc as $line) {
			$elements = explode(",", $line);
			array_push($words, new Word($elements[0], $elements[1], $elements[2]));
		}
	}

	function run(){
		$worldList = getWordList();
		return getHappiness($wordList,$phrase);
	}
}
?>