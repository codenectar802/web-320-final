<?php

class User {
	private $id;
	private $fname;
	private $lname;
	private $username;
	private $email;
	private $joined;



	// On construction the dbhandler will fill in the id and date joined
	// this function alst takes params as a dict of keys which should 
	// be named after the member variables and point to the desired value
	// THIS SHOULD ONLY BE EXECUTED BY REGISTRATION FORM
	public function __construct($params) {
		foreach ($params as $key => $value) {
			$this->{$key} = $value;
		}
	}

	public function get_id() {return $this->id;}
	public function get_fname() {return $this->fname;}
	public function get_lname() {return $this->lname;}
	public function get_fullname() {return $this->fname . ' ' . $this->lname;}
	public function get_username() {return $this->username;}
	public function get_email() {return $this->email;}
	public function get_joined() {return $this->joined;}

	public function set_fname($fname) {$this->fname = $fname;}
	public function set_lname($lname) {$this->lname = $lname;}
	public function set_username($unsername) {$this->username = $username;}
	public function set_email($email) {$this->email = $email;}

}
?>