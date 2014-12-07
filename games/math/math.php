<?php

include "mathgame.php";

session_start();
if (!isset($_SESSION['math_game'])) {
    $game = new mathgame(null);
    if ((isset($_POST['gametype']))&&(isset($_POST['mod']))){
        $gt=$_POST['gametype'];
        $m=$_POST['mod'];
        $data = array('arg1'=>0,'arg2'=>0,'oppindex'=>0,'answer'=>0,'gametype'=>$gt,'mod'=>$m,'gametype'=>$gt,'right'=>0,'wrong'=>0,'useranswer'=>0,'problemset'=>25);
        $game = new mathgame($data);
        play_turn($game);
        $_SESSION['math_game'] = $game;
    } else {
        game_options();
    }
}elseif(isset($_POST['math_action'])){
    
    $game = $_SESSION['math_game'];
    switch ($_POST['math_action']){
        case 'check_answer':
            check_answer($game);
            $_SESSION['math_game'] = $game;
            break;
        case 'end_game' :
            game_options();
            break;
    }
    
} else {
    if ((isset($_POST['gametype']))&&(isset($_POST['mod']))){
        $gt=$_POST['gametype'];
        $m=$_POST['mod'];
        $data = array('arg1'=>0,'arg2'=>0,'oppindex'=>0,'answer'=>0,'gametype'=>$gt,'gametype'=>$gt,'right'=>0,'wrong'=>0,'useranswer'=>0,'problemset'=>$m);
        $game = new mathgame($data);
        play_turn($game);
        $_SESSION['math_game'] = $game;
    } else {
        game_options();
    }
    $game = $_SESSION['math_game'];
}


function game_options(){
    $output = "";
    $output .= "<div id='options'>";
    $output .= "<form action='math.php' method='POST'>";
    $output .= "<h1>Math Game</h1>";
    $output .= "<h3>Solve for either:</br></h3>";
    $output .= "<input type='radio' name='gametype' value='op'>The Operator</br>";
    $output .= "<input type='radio' name='gametype' value='ans'>The Answer</br>";
    $output .= "<h3>How many problems:</br></h3>";
    $output .= "<input type='radio' name='mod' value='25'>25</br>";
    $output .= "<input type='radio' name='mod' value='50'>50</br>";
    $output .= "<input type='submit' name='Start Game' value='Start Game'></br>";
    $output .= "</form>";
    $output .= "</div>";
    echo $output;
}


//initialize the game
function play_turn($game) {
    //gen_problem($game->arg1,$game->opperators,$game->oppindex,$game->arg2,$game->answer);
    gen_problem($game);
    solve_problem($game);
    display_problem($game);
    return $game;
    
}
 
function gen_problem($game){
    //Random arguments
    $game->arg1=rand(1,10);
    $game->arg2=rand(1,10);
    //Random opperator 
    $game->oppindex=rand(0,3);
    return $game;
}

function solve_problem($game){
    //solve the problem
    switch ($game->opperators[$game->oppindex]){
        case '+':
            $game->answer=($game->arg1 + $game->arg2);
            return $game;
            break;
        case '-':
            $game->answer=($game->arg1 - $game->arg2);
            return $game;
            break;
        case '*':
            $game->answer=($game->arg1 * $game->arg2);
            return $game;
            break;
        case '/':
            $game->arg1=$game->arg1*$game->arg2;
            $game->answer=($game->arg1 / $game->arg2);
            return $game;
            break;
    } 
}

function display_problem($game){
    if ($game->gametype=='op'){
        //operator
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        $output .= "<h1>Guess the Operator!</h1></br>";
        $output .= "<h2>".$game->arg1." ? ".$game->arg2." = ".$game->answer."</h2></br>";
        $output .= "<h3>Your answer?</h3></br>";
        $output .= "<input type='hidden' name='math_action' value='check_answer'>";
        $output .= "<input type='text' name='answer'></br></br>";
        $output .= "<input type='submit' name='submit' value='Check Answer'></br>";
        $output .= "</form>";
        $output .= "</div>";
        echo $output;
    }elseif ($game->gametype=='ans'){
        //answer
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        $output .= "<h1>Guess the Answer!</h1></br>";
        $output .= "<h2>".$game->arg1." ".$game->opperators[$game->oppindex]." ".$game->arg2." = ?</h2></br>";
        $output .= "<h3>Your answer?</h3></br>";
        $output .= "<input type='hidden' name='math_action' value='check_answer'>";
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

function check_answer($game){
    //check the answer
    if ($game->gametype=='op'){
        //operator
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        $game->useranswer = $_POST['answer'];
        if ($game->useranswer==$game->opperators[$game->oppindex]){
            $game->right++;
        }else{
            $game->wrong++;
        }
        $output .= "<h3>Your score: [$game->right]:Right [$game->wrong]:Wrong out of [$game->problemset]:Questions</h3>";
        echo $output;
        if ($game->mod=='50'){
            if(($game->right+$game->wrong)==50){
                game_over($game);
            }else{
                play_turn($game);
            }
        }else{
            if(($game->right+$game->wrong)==25){
                game_over($game);
            }else{
                play_turn($game);
            }
        }
        
        
    }elseif ($game->gametype=='ans'){
        //answer
        $output = "<div id='gamewindow'>";
        $output .= "<form method='post'>";
        $game->useranswer = $_POST['answer'];
        if ($game->useranswer==$game->answer){
            $game->right++;
        }else{
            $game->wrong++;
        }
        $output .= "<h3>Your score: [$game->right]Right [$game->wrong]:Wrong out of [$game->problemset]:Questions</h3>";
        echo $output;
        if ($game->mod=='50'){
            if(($game->right+$game->wrong)==50){
                game_over($game);
            }else{
                play_turn($game);
            }
        }else{
            if(($game->right+$game->wrong)==25){
                game_over($game);
            }else{
                play_turn($game);
            }
        }
        
    }else{
        //error
        echo "<h3>Error choose a gametype</h3>";
    }
    
}


function game_over($game){
    $output = "";
    $output .= "<form method='post'>";
    $output .= "<h3>Your Final score: [$game->right]Right [$game->wrong]:Wrong out of [$game->problemset]:Questions</h3>";
    $output .= "<input type='hidden' name='math_action' value='end_game'>";
    $output .= "<input type='submit' name='submit' value='Reset Game'></br>";
    $output .= "</form>";
    echo $output;
}



?>
