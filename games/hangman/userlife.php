<?php
class userlife {
	var $health;
	var $over;		
	var $score;		
	var $won;		

	function start()
	{
		$this->score = 0;
		$this->health = 100;
		$this->over = false;
		$this->won = false;
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