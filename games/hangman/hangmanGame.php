<?php
class hangman
{
	public $alphabet = array( "a", "b", "c", "d", "e", "f", "g", "h","i", "j","k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
	public $health;
	public $over = False;		
	public $score;		
	public $won;
	public $option;
	public $guesses = 7;				
	public $isOver;	
	public $letters = array();
	public $AlphabetIndex;	
	public $WordAsLetterss = array();	
	public $WordFromList = array();
	public $difficulty = 'Easy';
	public function __construct($params) {
		if ($params){
			foreach ($params as $key => $value) {
				$this->{$key} = $value;
			}
		}
	}
	
	//Loads a new game. Score is set to 0. Health is set to 100
	public function newGame()
	{
		$this->setWord();
		$this->isOver();
		$this->score = 0;
		$this->health = 100;
		$this->over = false;
		$this->won = false;
	}
	
	public function end()
	{
	$this->over = true;
	}
	
	
	public function setScore($amount = 0)
	{
	return $this->score += $amount;
	}
	
	public function setHealth($amount = 0)
	{			
	return floor($this->health += $amount);
	}
	
	public function isOver()
	{
		if ($this->won)
			return true;
		if ($this->over)
			return true;
		if ($this->health < 0) 
			return true;	
		return false;
	}
	// Sets the word from database as Letter arrays
	public function wordToArray()
	{
		$this->WordAsLetterss = array();
		
		for ($i = 0; $i < strlen($this->WordFromList[$this->AlphabetIndex]); $i++)
			array_push($this->WordAsLetterss, $this->WordFromList[$this->AlphabetIndex][$i]);
	}
	
	public function setWord() {
		//loads and converts word list
		if (empty($this->WordFromList)) {
			$this->loadWords();
		}
		if (!empty($this->WordFromList))
			$this->AlphabetIndex = rand(0, count($this->WordFromList)-1);
			$this->wordToArray();
	}
	
	//Gets word from Database
	public function loadWords()
	{
		$dbconnection=mysqli_connect("localhost", "root", "root","web320final") or die ('cannot connect to DB');
		
		$query = "SELECT * FROM words WHERE difficulty = '".$this->difficulty."' ORDER BY RAND();";
		if ($result = mysqli_query($dbconnection, $query)){
		while ($data=mysqli_fetch_assoc($result))
			array_push($this->WordFromList, trim($data['word']));
		}
	}
	//Sets the score and pushes to the database
	public function storeScore ($id,$scored) {
		$scoreIt = "INSERT INTO `hangmanScore`
		(`id`,`scored`)
		VALUES (".$id.",'".$scored."');";
		$this->dbconnection->score;
		array_push ($this->score->scored);
	}
	
	
	// New game function
	public function playGame() {
		if (isset($_POST['change']) )
			$this->changeDifficulty($_POST['difficulty']);
				
		if (isset($_POST['newGame']) || empty($this->WordFromList))
			$this->newGame();
			
		if (!$this->isOver && (isset($_POST['letter'])))
			echo $this->guessLetter($_POST['letter']);
				
		$this->displayGame();
	}
	public function displayGame()
	{
		 if (!$this->over)
        
		//Displays guessed letter as well as changes the pictures if guessed wrong
		  if (!empty($this->letters))
		  
					echo "<div id=\"guessedLetters\">Letters Guessed: " . implode($this->letters, ", ") . "</div>";
		if (!$this->isOver)
		{
			echo "<div id=\"picture\">" . $this->picture() . "</div>
			 <div id=\"guessWord\">" . $this->solvedWord() . "</div>
			 <div id=\"selectLetter\">
			 Enter A Letter:
			 <input type=\"text\" name=\"letter\" value=\"\" maxlength=\"1\" />
			 <input type=\"submit\" name=\"submit\" value=\"Guess\" />
			 </div>";
				  
				
			
			//Changes the difficulty		
			echo "<div id=\"changeDifficulty\">
					Difficulty:
						<select name=\"difficulty\"/>
			<option value=\"1\">Easy</option>
										
			<option value=\"2\""; if ($this->difficulty == "Medium") echo " selected=\"selected\""; echo ">Medium</option>
										
			<option value=\"3\""; if ($this->difficulty == "Hard") echo " selected=\"selected\""; echo ">Hard</option>
							
			</select>
			<input type=\"submit\" name=\"change\" value=\"Change\" />
			 </div>";
		}
		else
		{
			//If you win or lose
			if ($this->won)
				echo success("Congratulats you win!<br/>
								Your final score was: $this->score");
			else if ($this->health <= 0)
			{
				echo fail("Better luck next time!<br/>
								Your final score was: $this->score");
				echo "<div id=\"picture\">" . $this->picture() . "</div>";
			}
			echo "<div id=\"start_game\"><input type=\"submit\" name=\"newgame\" value=\"New Game\" /></div>";
		}
	}
	//Difficulty function
	public function changeDifficulty($option)
	{		
		switch ($option)
		{
			case 1: $this->difficulty = "Easy"; break;
			case 2: $this->difficulty = "Medium"; break;
			case 3: $this->difficulty = "Hard"; break;
			default:$this->difficulty = "Easy";
		}
		/*loads the words and starts a new game after changing difficulty*/
		$this->WordFromList = Array();
		$this->loadWords();
		$this->newGame();
	}
 // END CLASS DEFF
	/*letter guessing*/
	
	public function guessLetter($letter)
	{			
		if ($this->isOver)
			return;
		if (!is_string($letter) || strlen($letter) != 1 || !$this->isLetter($letter))
			return fail("You have not entered a letter.");
/* checks for guessed letter*/
		if (in_array($letter, $this->letters))
			return fail("You have already guessed this letter.");
		if (!(strpos($this->WordFromList[$this->AlphabetIndex], $letter) === false))
		{
			/*difficulities*/
			switch ($this->difficulty)
			{
				default: $multiplier = 1; break;
				case "Easy": $multiplier = 1; break;
				case "Medium": $multiplier = 2; break;
				case "Hard": $multiplier = 3; break;
			}
			
		
			//increase their score based on how many guesses they've used so far
	  if ($this->health > (100/floor($this->guesses/5)))
		  $this->setScore((5 * $multiplier));
	  else if ($this->health > (100/floor($this->guesses/4)))
		  $this->setScore((4 * $multiplier));
	  else if ($this->health > (100/floor($this->guesses/3)))
		  $this->setScore((3 * $multiplier));
	  else if ($this->health > (100/floor($this->guesses/2)))
		  $this->setScore((2 * $multiplier));
	  else
		  $this->setScore((1 * $multiplier));
				
			/*adds correct letter to array*/
			array_push($this->letters, $letter);
			
			if (implode(array_intersect($this->WordAsLetterss, $this->letters), "") ==
				 strtolower($this->WordFromList[$this->AlphabetIndex]))
				$this->won = true;
			else
				return success("You guessed correctly!");
		}
		
		else 
		{
			$this->setHealth(floor(100/$this->guesses) * -1);
			array_push($this->letters, $letter);
			
			if ($this->isOver)
			return;
			else return fail("There is no $letter in this word.");
		}
	}
	public function picture()
	{
		$count = 1;
		for ($i = 100; $i >= 0; $i-= floor(100/$this->guesses))
		{
			if ($this->health == $i)
			{
			if (file_exists("images/" . ($count-1) . ".jpg"))
			return "<img src=\"images/" . ($count-1) . ".jpg\" alt=\"Hangman\" title=\"Hangman\" />";
			}
				
			$count++;
		}
		return "<img src=\"images/" . ($count-1) . ".jpg\" alt=\"Hangman\" title=\"Hangman\" />";
	}
	
	
	/*display correctly guessed letters*/
	public function solvedWord()
	{
		$result = "";
		for ($i = 0; $i < count($this->WordAsLetterss); $i++)
		{
			$found = false;
			foreach($this->letters as $letter) {
				if ($letter == $this->WordAsLetterss[$i])
				{
					$result .= $this->WordAsLetterss[$i]; 
					$found = true;
				}}
			
			if (!$found && $this->isLetter($this->WordAsLetterss[$i]))
				$result = $result . "_  "; 
		}
		return $result;
	}
	
	
	//Makes sure that the entry is a lowercase alphabet letter
	public function isLetter($value)
	{
		if (in_array($value, $this->alphabet))
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