<?php

class Typing_Database_Handler {
	private $link;
	private $status = "ubnkown";

	public function __construct() {
		$servername = "localhost";
		$username = "root";
		$password = "root";
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

	public function store_score() {
		
	}
}

?>