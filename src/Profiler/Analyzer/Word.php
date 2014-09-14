<?php
namespace Profiler\Analyzer;
class Word {
  public $text = "";
  public $happy = 0;    public $sad = 0;
  function __construct($txt, $happy, $sad) {
    $this->text = $txt;
    $this->happy = $happy;
    $this->sad = $sad;
  }
  function getText() {
    return $this->text;
  }
  }
?>