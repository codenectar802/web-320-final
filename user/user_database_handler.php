<?php
include 'user.php';

class User_Database_Handler {
	private $link;
	private $status;

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

	// Creates a new user in the databse and returns a complete user with id and date joined
	// This should only be used by the signup form
	public function create_user($new_user, $pass_input) {
		$date_created = date('Y-m-d H:i:s');
		$sql = "INSERT INTO `user` (`fname`,`lname`,`username`,`email`,`date_joined`)
				VALUES
				('".$new_user->get_fname()."','".$new_user->get_lname()."','".$new_user->get_username()."'
					,'".$new_user->get_email()."','".$date_created."');";
		$result = $this->link->query($sql);
		$pass_hash = md5($pass_input);
		$username = $new_user->get_username();
		$new_user = $this->get_user_by_username($username);
		sleep(2);
		$new_user = $this->get_user_by_username($username);
		
		$sql = "INSERT INTO `pass`
				(`userid`,
				`password`)
				VALUES
				(".$new_user->get_id().",
				'".$pass_hash."');";
		$this->link->query($sql);
		return $new_user;
	}

	// Get user with the specified userid
	public function get_user($userid) {
		$sql = "SELECT * FROM user WHERE id = '".$userid."';";
		$result = $this->link->query($sql);
		return $result->num_rows > 0 ? new User($result->fetch_assoc()) : null;
	}
	// Get user with the specified username
	public function get_user_by_username($username) {
		$sql = "SELECT * FROM user WHERE username = '".$username."';";
		$result = $this->link->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$user = new User($row);
			return $user;
		} else {
			return null;
		}
		
	}
	// Get user with the specified email
	public function get_user_by_email($email) {
		$sql = "SELECT * FROM user WHERE email = '".$email."';";
		$result = $this->link->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$user = new User($row);
			return $user;
		} else {
			return null;
		}
	}

	// This will update the db-row with u$ser.id value with exactly what is in the
	// $user object
	public function update_user($user) {
		$sql = "UPDATE user SET	fname = '" . $user->get_fname() . "'
								lname = '" . $user->get_lname() . "'
								username = '" . $user->get_username() . "'
								email = '" . $user->get_email() . "'
				WHERE id=" . $user->get_id() . ";";
		$this->link->query($sql);
	}

	public function verify_password($pass_input, $userid) {
		$sql = "SELECT * FROM pass WHERE userid = ".$userid.";";
		$result = $this->link->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$input_hash = md5($pass_input);
			if ($row['password'] == $input_hash) {
				return True;
			} else {
				return False;
			}

		} else {
			echo "no password found";
		}
	}
	public function update_password($userid, $new_pass) {
		$pass_hash = md5($new_pass);
		$sql = "UPDATE pass SET 'password' = '".$pass_hash."' WHERE 'userid' = ".$userid.";";
		$this->link->query($sql);
	}
}

?>