<?php


//Generate argument variables
$arg1=0;
$arg2=0;
//Generate opperator variables
$oppindex=0;
$opperators=array('+','-','*','/');
//Generate answer variable
$answer=0;
//Generate gametype and modifer variables
$gametype='';
$mod='';
//Generate score variables
$right=0;
$wrong=0;
//Generate problem set variable
$problemset=25;
//Generate useranswer variable
$useranswer="";

//post action
$post_action=$_POST['submit'];
if ($post_action=='Start Game'){
    ini_game();
}elseif ($post_action=='Check Answer'){
    check_answer();
}

//initialize the game
function ini_game() {
    global $arg1,$opperators,$oppindex,$arg2,$answer,$gametype,$mod;
    $gametype=$_POST['gametype'];
    $mod=$_POST['mod'];
    //check modifier
    if ($mod=='race'){
        //race timer
    }elseif ($mod=='set'){
        //problem set
    }else{
        //error
        echo "<h3>Error choose a game modifier</h3>";
    }
    
    gen_problem($arg1,$opperators[$oppindex],$arg2,$answer);
    solve_problem($arg1,$opperators[$oppindex],$arg2,$answer);
    display_problem($arg1,$opperators[$oppindex],$arg2,$answer,$gametype);
    
}
 
function gen_problem(){
    global $arg1,$oppindex,$arg2,$answer;
    //Random arguments
    $arg1=rand(1,10);
    $arg2=rand(1,10);
    //Random opperator 
    $oppindex=rand(0,3);
    //Reset answer before solve
    $answer=0;
}

function solve_problem(){
    global $arg1,$opperators,$oppindex,$arg2,$answer;
    //solve the problem
    switch ($opperators[$oppindex]){
        case '+':
            $answer=($arg1 + $arg2);
            break;
        case '-':
            $answer=($arg1 - $arg2);
            break;
        case '*':
            $answer=($arg1 * $arg2);
            break;
        case '/':
            $arg1=$arg1*$arg2;
            $answer=($arg1 / $arg2);
            break;
    } 
}

function display_problem(){
    global $arg1,$opperators,$oppindex,$arg2,$answer,$gametype,$mod,$post_action;
    //echo $arg1;
    //echo $opperators[$oppindex];
    //echo $arg2;
    //echo " = ";
    //echo $answer;
    //echo $gametype;
    //echo $mod;
    //check gametype
    if ($gametype=='op'){
        //operator
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        $output .= "<h1>Guess the Opperator!</h1></br>";
        $output .= "<h2>$arg1 ? $arg2 = $answer</h2></br>";
        $output .= "<h3>Your answer?</h3></br>";
        $output .= "<input type='text' name='answer'></br></br>";
        $output .= "<input type='submit' name='submit' value='Check Answer'></br>";
        $output .= "</form>";
        $output .= "</div>";
        echo $output;
    }elseif ($gametype=='ans'){
        //answer
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        $output .= "<h1>Guess the Answer!</h1></br>";
        $output .= "<h2>$arg1 $opperators[$oppindex] $arg2 = ?</h2></br>";
        $output .= "<h3>Your answer?</h3></br>";
        $output .= "<input type='text' name='answer'></br></br>";
        $output .= "<input type='submit' name='submit' value='Check Answer'></br>";
        $output .= "</form>";
        $output .= "</div>";
        echo $output;
    }else{
        //error
        echo "<h3>Error choose a gametype</h3>";
    }
    
}

function check_answer(){
    //check the answer
    global $arg1,$opperators,$oppindex,$arg2,$answer,$gametype,$right,$wrong,$useranswer,$post_action;
    if ($gametype=='op'){
        //operator
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        if ($useranswer==$opperators[$oppindex]){
            $right++;
        }else{
            $wrong++;
        }
        $output .= "<h3>Your score: [$right]Right [$wrong]:Wrong out of [$problemset]:Questions</h3>";
        $output .= "<h1>Guess the Opperator!</h1></br>";
        $output .= "<h2>$arg1 ? $arg2 = $answer</h2></br>";
        $output .= "<h3>Your answer?</h3></br>";
        $output .= "<input type='text' name='answer'></br></br>";
        $output .= "<input type='submit' name='submit' value='Check Answer' onclick='check_answer()'></br>";
        $output .= "</form>";
        $output .= "</div>";
        echo $output;
    }elseif ($gametype=='ans'){
        //answer
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        if ($useranswer==$answer){
            $right++;
        }else{
            $wrong++;
        }
        $output .= "<h3>Your score: [$right]Right [$wrong]:Wrong out of [$problemset]:Questions</h3>";
        $output .= "<h1>Guess the Answer!</h1></br>";
        $output .= "<h2>$arg1 $opperators[$oppindex] $arg2 = ?</h2></br>";
        $output .= "<h3>Your answer?</h3></br>";
        $output .= "<input type='text' name='answer'></br></br>";
        $output .= "<input type='submit' name='submit' value='Check Answer' onclick='check_answer()'></br>";
        $output .= "</form>";
        $output .= "</div>";
        echo $output;
    }else{
        //error
        echo "<h3>Error choose a gametype</h3>";
    }
    
}

function display_modifier(){
    //displays up top either:
    //timer for race
    //our question number out of $problem set
}

function game(){
    //determine success criteria
    //check modifier
    if ($mod=='race'){
        //race timer
        //when timer reaches zero game over
        //display game over screen with score
        //display play again button, reloads math.html
    }elseif ($mod=='set'){
        //problem set
        //if problemsdisplayed is more than problem set game over
        //display game over screen with score
        //display play again button, reloads math.html
    }
}
?>
