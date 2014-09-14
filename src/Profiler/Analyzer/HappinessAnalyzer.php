<?php
// sentiment analyzis from Alex Davies: http://alexdavies.net/twitter-sentiment-analysis/
namespace Profiler\Analyzer;
require "Word.php";
// use Profiler\Analyzer\Word;
class HappinessAnalyzer{
	protected $phrase;

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
		$doc = explode("\n",file_get_contents("src/Profiler/Analyzer/sentiment_list.csv"));
		foreach ($doc as $line) {
			$elements = explode(",", $line);
			array_push($words, new Word($elements[0], $elements[1], $elements[2]));
		}
	}

	function run(){
		$worldList = $this->getWordList();
		return $this->getHappiness($wordList,$phrase);
	}
}
?>