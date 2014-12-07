<?php
class TypingGame {
	public $score;
	public $difficulty;
	public $round_num;
	private $target_string;
	public $target_time;
	public $hearts;
	private $difficulty_settings = array(
		'easy'=>array('score_modifier'=>1, 'cpm_target'=>100, 'low'=>2, 'high'=>5),
		'medium'=>array('score_modifier'=>2, 'cpm_target'=>200, 'low'=>5, 'high'=>8),
		'hard'=>array('score_modifier'=>3, 'cpm_target'=>300, 'low'=>9, 'high'=>12));

	public function __construct($params) {
		if ($params){
			foreach ($params as $key => $value) {
				$this->{$key} = $value;
			}
		}
	}

	public function get_target_string() { return $this->target_string; }

	// return true if continue round
	// return true if input wrong and end round
	public function play_turn($user_input) {
		if ($user_input==$this->target_string) {
			$this->round_num += 1;
			$this->score += ($this->round_num * $this->difficulty_settings[$this->difficulty]['score_modifier']);
			$this->new_round();
		} else {
			if ($this->hearts>0) {
				$this->hearts -= 1;
				$this->round_num += 1;
				$this->new_round();
			}
		}
	}

	// alters variables in this instance to initial state
	public function start_new_game($difficulty) {
		// default data
		$this->score = 0;
		$this->hearts = 3;
		$this->round_num = 1;
		$this->difficulty = $difficulty;
		$this->new_round();
	}

	public function new_round() {
		$settings = $this->difficulty_settings[$this->difficulty];
		$rand_num_of_words = rand($settings['low'], $settings['high']);
		$target_words = $this->get_common_words($rand_num_of_words);
		$this->target_string = implode($target_words, " ");
		$num_of_chars = strlen($this->target_string);
		$target_cpm = (($this->round_num * 2) + $settings['cpm_target']);
		$this->target_time = round(($num_of_chars/$target_cpm) * 60);

	}

	public function get_common_words($num_of_words) {
		$words = array();
		$file_handle = fopen("500commonwords.csv", "r");
		while (!feof($file_handle) ) { $words[] = fgetcsv($file_handle, 1024);}
		fclose($file_handle);
		$return_words = array();
		for ($i=0; $i < $num_of_words; $i++) { 
			array_push($return_words, $words[rand(0, 499)][0]);
		}
		return $return_words;
	}
}



?>