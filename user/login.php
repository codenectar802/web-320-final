<?php

include 'user_database_handler.php';

class Login_Manager {
	public $user_dbhandler;
	public $user;// Holds user object
	public $logged_in;// Is logged in?

	public function __construct($login_cookie) {
		$data = explode("_", $login_cookie);
		$this->logged_in = $data[0] == 't' ? True : False;

		$this->user_dbhandler = new User_Database_Handler();
		$this->user = $this->user_dbhandler->get_user($data[1]);
	}

	// name_input can be either an email or a username
	public function login($name_input, $pass_input) {
		// First try and get by username
		$target_user = $this->user_dbhandler->get_user_by_username($name_input);
		if ($target_user == null) {
			// Then try and get by email
			$target_user = $this->user_dbhandler->get_user_by_email($name_input);
		}
		if (!$target_user == null) {
			$verified = $this->user_dbhandler->verify_password($pass_input, $target_user->get_id());
			if ($verified == True) {
				$this->user = $target_user;
				$this->logged_in = True;
				return True;
			}
		}
		return False;
	}

	function check_if_available($username, $email) {
		$username_available = True;
		$email_available = True;
		if ($this->user_dbhandler->get_user_by_username($_POST['username_input'])==null){
			$username_available = False;
		}
		if ($this->user_dbhandler->get_user_by_email($_POST['email_input'])==null){
			$email_available = False; 
		}
		return array($username_available, $email_available);
	}

	public function logout() {
		$this->logged_in = False;
	}


	public function get_current_cookie_value() {
		$string = $this->logged_in ? "t_" : "f_";
		return $string.$this->user->get_id();
	}
}


?>