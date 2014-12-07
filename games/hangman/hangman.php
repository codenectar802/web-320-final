<?php

class hangman extends userlife 
{
	
	public $guesses;				
	public $letters = array();		
	public $option;
	public $Index;				
	public $WLetters = array();	
	public $wList = array();
	public $difficulty ;
	public $alphabet = array( "a", "b", "c", "d", "e", "f", "g", "h","i", "j","k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
	

/*start game*/
	public function hangman()
	{
		userlife::start();
	}
	
	/*changes difficulty options. Easy-Medium-Hard*/
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
		$this->wList = Array();
		$this->loadWords();
		$this->newGame();
	}
	public function newGame($max_guesses = 7)
	{
/*starts game, clears gussed letters, sets guess limit*/
		$this->start();
		$this->letters = array();
		if ($max_guesses)
			$this->setGuesses($max_guesses);
			$this->setWord();
	}
	
	 public function playGame()
	{
		if (isset($_POST['change']) )
			$this->changeDifficulty($_POST['difficulty']);
				
		if (isset($_POST['newGame']) || empty($this->wList))
			$this->newGame();
			
		if (!$this->isOver() && (isset($_POST['letter'])))
			echo $this->guessLetter($_POST['letter']);
				
		$this->displayGame();
	}
	/*set guesses*/
	public function setGuesses($amount = 0)
	{		
		$this->guesses = $amount;
	}
	
	/*display game*/
	public function displayGame()
	{
		 if (!$this->isOver())
        
		/*display guessed letters*/
		  if (!empty($this->letters))
		  
					echo "<div id=\"guessedLetters\">Letters Guessed: " . implode($this->letters, ", ") . "</div>";
		if (!$this->isOver())
		{
			echo "<div id=\"picture\">" . $this->picture() . "</div>
			 <div id=\"guessWord\">" . $this->solvedWord() . "</div>
			 <div id=\"selectLetter\">
			 Enter A Letter:
			 <input type=\"text\" name=\"letter\" value=\"\" maxlength=\"1\" />
			 <input type=\"submit\" name=\"submit\" value=\"Guess\" />
			 </div>";
				  
				/*choose difficulty*/
					
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
			/*winner winner chicken dinner*/
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
	
	/*letter guessing*/
	
	public function guessLetter($letter)
	{			

		if ($this->isOver())
			return;

		if (!is_string($letter) || strlen($letter) != 1 || !$this->isLetter($letter))
			return fail("You have not entered a letter.");
			
/* checks for guessed letter*/
		if (in_array($letter, $this->letters))
			return fail("You have already guessed this letter.");
			

			
		if (!(strpos($this->wList[$this->Index], $letter) === false))
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
	  if ($this->health > (100/floor($this->guesses/6)))
		  $this->setScore((6 * $multiplier));
	  else if ($this->health > (100/floor($this->guesses/5)))
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
			
			if (implode(array_intersect($this->WLetters, $this->letters), "") ==
				 strtolower($this->wList[$this->Index]))
				$this->won = true;
			else
				return success("You guessed correctly!");
		}
		else 
		{
			$this->setHealth(floor(100/$this->guesses) * -1);
			array_push($this->letters, $letter);
			
			if ($this->isOver())
			return;
			else return fail("There is no $letter in this word.");
		}
	}
	
/*selects random word from database*/
	public function setWord()
	{
/*loads and converts word list*/
		if (empty($this->wList))
			$this->loadWords();
			if (!empty($this->wList))
			$this->Index = rand(0, count($this->wList)-1);
			$this->wordToArray();
	}
	
	/*selects words based on difficulty selected*/
	public function loadWords()
	{
$dbconnection=mysqli_connect("localhost", "root", "","web320final") or die ('cannot connect to DB');
$connection= mysqli_select_db($dbconnection, "web320final");
	
		if (mysqli_connect_errno()) ;
		{
    echo "failed". mysqli_connect_error();
	exit();
		}
		
		$query= "SELECT word WHERE difficulty='$this->difficulty' ORDER BY RAND()";
		$result = mysqli_query($connection, $query);
		$data = mysqli_fetch_assoc($result);
		array_push($this->wList, trim($data['word']));
		}
	}
	
		//if ($result = mysqli_query($link, "SELECT word * FROM web320final WHERE difficulty='$this->difficulty' ORDER BY RAND() ", MYSQLI_USE_RESULT)) {
 		//if (!mysqli_query($link, "SET @a:='this will not work'")) {
    
		//mysqli_free_result($result);
		//}}
		//$sql = "SELECT * FROM table_name";
		//$result = mysql_query($sql);
		//while ($data = mysqli_fetch_assoc($result))
		//array_push($this->wList, trim($data['word']));
		//mysqli_close($link);
		/*
		$loop = mysqli_query("
		SELECT word
		FROM web320final
		WHERE difficulty='$this->difficulty'
	    ORDER BY RAND()
		LIMIT 1")
		or die ('Cant connect to db');
			
		while ($data = mysqli_fetch_assoc($loop))
			array_push($this->wList, trim($data['word']));
	}
	*/
	/*displays images*/


	 function picture()
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

	 function solvedWord()
	{
		$result = "";
		for ($i = 0; $i < count($this->WLetters); $i++)
		{
			$found = false;
			foreach($this->letters as $letter) {
				if ($letter == $this->WLetters[$i])
				{
					$result .= $this->WLetters[$i]; 
					$found = true;
				}}
			
			if (!$found && $this->isLetter($this->WLetters[$i]))
				$result .= "_  "; 
		}
		return $result;
	}
	
	/*converts word to Array*/
	 function wordToArray()
	{
		$this->WLetters = array(); 
		
		for ($i = 0; $i < strlen($this->wList[$this->Index]); $i++)
			array_push($this->WLetters, $this->wList[$this->Index][$i]);
	}
	
	/*checks if input is an alphabet letter */
	 function isLetter($value)
	{
		if (in_array($value, $this->alphabet))
		return true;
		return false;
	}
	
	?>