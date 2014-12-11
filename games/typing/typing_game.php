<?php
class TypingGame {
	public $score;
	public $difficulty;
	public $round_num;
	private $target_string;
	public $target_time;
	public $hearts;

	public function __construct($params) {
		if ($params){
			foreach ($params as $key => $value) {
				$this->{$key} = $value;
			}
		}
	}


	// alters variables in this instance to initial state
	public function start_new_game($difficulty) {
		// default data
		x$this->score = 0;
		$this->hearts = 3;
		$this->round_num = 1;
		
		$this->difficulty = $difficulty;
		switch ($this->difficulty) {
			case 'easy':
				$new_game = $this->get_easy();
				break;
			case 'medium':
				$new_game = $this->get_medium();
				break;
			case 'hard':
				$new_game = $this->get_hard();
				break;
			default:
				$new_game = $this->get_easy();
				break;
		}
	}


	// Easy game between (100 - 150) characters per minute [CPM]
	public function get_easy() {
		$rand_num_of_words = rand(2, 5);
		$target_words = $this->get_common_words($rand_num_of_words);
		$this->target_string = implode($target_words, " ");

		$num_of_chars = strlen($target_string);
		$target_cpm = (($this->round_num * 2) + 100);
		$this->target_time = round(($num_of_chars/$target_cpm) * 60);



		echo "Number of words: ".$rand_num_of_words."<br>";
		echo "Target string: ".$this->target_string."<br>";
		echo "Length of target string: ".strlen($this->target_string)."<br>";
		echo "Target CPM: ".$target_cpm."<br>";
		echo "Target time: ".$this->target_time." secs<br>";
	}

	public function get_common_words($num_of_words) {
		$words = array();
		$file_handle = fopen("500commonwords.csv", "r");
		while (!feof($file_handle) ) {
		    $words[] = fgetcsv($file_handle, 1024);
		}
		fclose($file_handle);

		$return_words = array();
		$i;
		for ($i=0; $i < $num_of_words; $i++) { 
			$rand_int = rand(0, 499);
			$rand_array = $words[$rand_int];
			echo $rand_int." ".$rand_array[0]."<br>";
			array_push($return_words, $rand_array[0]);
		}
		return $return_words;
	}

}


// Test
$test_game = new TypingGame(null);
$test_game->get_easy(4);

?>