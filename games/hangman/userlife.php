<?php

class userlife {
	public $health;
	public $over;		
	public $score;		
	public $won;
	public $game;


	function __construct() {
		
	}
	 function hangman()
	{
		$this->score = 0;
		$this->health = 100;
		$this->over = false;
		$this->won = false;
		$this->game = new hangman();
	}

	public function display_game() {
		$this->game->displayGame();
	}
	
	/*game over*/
	 function end()
	{
	$this->over = true;
	}
	
	/*sets player score*/
	 function setScore($amount = 0)
	{
	return $this->score += $amount;
	}
	
	 function setHealth($amount = 0)
	{			
	return floor($this->health += $amount);
	}
	
	/*determines when game is over*/
	 function isOver()
	{
		if ($this->won)
			return true;
		if ($this->over)
			return true;
		if ($this->health < 0) 
			return true;	
		return false;
	}
} 

 function fail($msg)
{
return "<div class=\"fail\">$msg</div>";
}

 function success($msg)
{
	return "<div class=\"success\">$msg</div>";
}

?>