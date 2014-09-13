<?php
    namespace Profiler\Analyzer\CussAnalyzer;
    
    class CussAnalyzer {
	protected $phrase;
        
        //rate a particular string that may or may not contain swear words!
        public function __construct($phrase) {
            $this->phrase = $phrase;
        }
        
        public function run() {
            $swearWords = array(
                "fuck" =>10,
                "shit" =>5,
                "damn" =>5,
                "bitch" =>5,
                "crap" =>1,
                "piss" =>1,
                "dick" =>5,
                "darn" =>1,
                "cock" =>10,
                "pussy"=>10,
                "asshole"=>5,
                "fag" =>10,
                "slut" =>10,
                "bastard" =>5,
                "douche" =>1
            );
            $word = "";
            $stringLength = strlen($phrase);
            for ($i = 0; $i < $stringLength; $i++) {
                $char = $str[$i];
                if($char != "") {
                    $word += $char;
                } 
                foreach($swearWords as &$swear) {
                    if($word == $swear) {
                        return $swearWords[$swear];
                    }
                }
            }
            return 0;
        }
    }    
?>