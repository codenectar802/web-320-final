<?php
class game{
    //Generate argument variables
    public $arg1=0;
    public $arg2=0;
    //Generate opperator variables
    public $oppindex=0;
    public $opperators=array('+','-','*','/');
    //Generate answer variable
    public $answer=0;
    //Generate gametype and modifer variables
    public $gametype='';
    public $mod='';
    //Generate score variables
    public $right=0;
    public $wrong=0;
    //Generate problem set variable
    public $problemset=25;
    //Generate useranswer variable
    public $useranswer="";
    
    public function __construct(){
        //make empty
    }

}
?>