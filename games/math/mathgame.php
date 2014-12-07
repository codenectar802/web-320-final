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
    
    ////Generate argument variables
    //public $arg1;
    //public $arg2;
    ////Generate opperator variables
    //public $oppindex=0;
    //public $opperators=array('+','-','*','/');
    ////Generate answer variable
    //public $answer=0;
    ////Generate gametype and modifer variables
    //public $gametype='';
    //public $mod='';
    ////Generate score variables
    //public $right=0;
    //public $wrong=0;
    ////Generate problem set variable
    //public $problemset=25;
    ////Generate useranswer variable
    //public $useranswer="";

}
?>