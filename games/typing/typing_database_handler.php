<?php

class Typing_Database_Handler {
	private $link;
	private $status = "ubnkown";

	public function __construct() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "web320final";
		$link = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($link->connect_error) {
			$this->status = "disconnected";
			die("Connection failed: " . $link->connect_error);
		}
		$this->status = "connected";
		$this->link = $link;
	}

	public function store_score($userid, $difficulty, $score) {
		$sql = "INSERT INTO `typingScore`
		(`userid`,`difficulty`,`score`,`date`)
		VALUES (".$userid.",'".$difficulty."',".$score.",'".date('Y-m-d H:i:s')."');";
		$this->link->query($sql);
	}

	public function get_top_scores() {
		$top_scores = array();
		$diffs = array('easy', 'medium', 'hard');
		foreach ($diffs as $key => $value) {
			$sql = "SELECT * FROM typingScore WHERE difficulty = '".$value."' ORDER BY score DESC LIMIT 5;";
			$results = $this->link->query($sql);
			$scores = $this->results_to_array($results);
			array_push($top_scores, $scores);
		}	
		return $top_scores;
	}
	private function results_to_array($results) {
		$array = array();
		while ($row = $results->fetch_assoc()) {
		    array_push($array, $row);
		}
		return $array;
	}
}

?>