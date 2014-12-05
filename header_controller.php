<?php
session_start();

$cookie_name = "login_cookie";
$cookie_value = "f_1";

$signup_error = False;
$login_error = False;
$logout_error = False;

include('user/login.php');

if (!isset($_COOKIE[$cookie_name])) {
	$cookie_value = "f_1";
	// setcookie($cookie_name, $cookie_value, time()+(86400 * 30), "/");
	$user_login_manager = new Login_Manager($cookie_value);
} else {
	$user_login_manager = new Login_Manager($_COOKIE[$cookie_name]);
	// $user_login_manager = new Login_Manager("f_1");
	
	$cookie_value = $_COOKIE[$cookie_name];
}


if(isset($_POST['account_action'])) {

	if ($_POST['account_action'] == 'logout') {
		$user_login_manager->logout();
	} elseif ($_POST['account_action'] == 'login') {
		$success = $user_login_manager->login($_POST['name_input'], $_POST['pass_input']);
		$login_error = True;
	} elseif ($_POST['account_action'] == 'signup') {
		$availablility = $user_login_manager->check_if_available($_POST['username_input'], $_POST['email_input']);
		$signup_username_available = $availablility[0];
		$signup_email_available = $availablility[1];




		$signup_email_missing = empty($_POST['email_input']) ? True : False;
		$signup_fname_missing = empty($_POST['fname_input']) ? True : False;
		$signup_lname_missing = empty($_POST['lname_input']) ? True : False;
		$signup_username_missing = empty($_POST['username_input']) ? True : False;
		$signup_pass_missing = empty($_POST['pass_input']) ? True : False;

		$errors = array($signup_username_available, 
						$signup_email_available, 
						$signup_email_missing, 
						$signup_fname_missing, 
						$signup_lname_missing,
						$signup_username_missing,
						$signup_pass_missing);
		$signup_error = False;
		foreach ($errors as $error) {
			if ($error==True) {
				$signup_error = True;
			}
		}
		if (!$signup_error) {
			$data = array(
					'email'=>$_POST['email_input'],
					'fname'=>$_POST['fname_input'],
					'lname'=>$_POST['lname_input'],
					'username'=>$_POST['username_input'],
					'email'=>$_POST['email_input'],
				);
			$new_user = new User($data);
			$new_user = $user_login_manager->user_dbhandler->create_user($new_user, $_POST['pass_input']);
			$success = $user_login_manager->login($_POST['username_input'], $_POST['pass_input']);
		} 

	}
}

setcookie($cookie_name, $user_login_manager->get_current_cookie_value(), time()+(86400 * 30), "/");

?>
