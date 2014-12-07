<?php
class mathgame{
    public $arg1;
    public $arg2;
    public $oppindex;
    public $opperators=array('+','-','*','/');
    public $answer;
    public $gametype;
    public $mod;
    public $right;
    public $wrong;
    public $useranswer;
    
    public function __construct($params){
        if ($params){
            foreach ($params as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}
?>