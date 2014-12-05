

<?php

	echo "<link rel='stylesheet' type='text/css' href='".$root_path."libs/bootstrap-3.2.0/css/bootstrap.min.css'>";
    echo "<link rel='stylesheet' type='text/css' href='".$root_path."css/index.css'>";
    echo "<link rel='stylesheet' type='text/css' href='".$root_path."css/typing.css'>";
	echo "<script src='http://code.jquery.com/jquery-2.1.1.min.js'></script>";
    echo "<script src='".$root_path."libs/bootstrap-3.2.0/js/bootstrap.js'></script>";
    echo "<script src='".$root_path."js/index.js'></script>";
?>


<div class="header_div">
<div class="container">
	<div class="header_menu">
		<ul class="nav navbar-nav main-nav pull-right">
			<?php
				if ($user_login_manager->logged_in == True) {
					echo "<li class='username_display'><div>".$user_login_manager->user->get_fullname()."</div></li>";
					echo "<li><button class='btn btn-default' id='logout_link' data-toggle='modal' data-target='#logoutModal'>Log Out</button></li>";
				} elseif ($user_login_manager->logged_in == False) {
					echo "<li>
								<button class='btn btn-default' id='login_link' data-toggle='modal' data-target='#loginModal'>
									Log In
								</button>
							</li>
				          <li><button class='btn btn-default' id='signup_link' data-toggle='modal' data-target='#signUpModal'>Sign Up</button></li>";
				} else {
					echo "<li>We have an issue</li>";
				}
			?>
        </ul>
        <div class="logo_container">
        	<?php 
        		// root_path must be set just before the header is included
        		// it point to the root directory of the project
        		echo "<div><a href='".$root_path."home.php'>Conscious Games</a>";
        	?>
			</div>
		</div>
	</div>

	<!-- login Modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	  <?php include 'partials/login_modal.php'; ?>
	</div>

	<!-- signup Modal -->
	<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel" aria-hidden="true">
	  <?php include 'partials/signup_modal.php'; ?>
	</div>

	<!-- logout Modal -->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
	  <?php include 'partials/logout_modal.php'; ?>
	</div>

</div>
</div>
<br>
<?php 
	echo "<script type='text/javascript'>";
		    if($signup_error) {
		    	echo "$('#signUpModal').modal('show');";
		    } elseif ($login_error) {
		    	echo "$('#loginModal').modal('show');";
		    }
		        
	echo "</script>";

?>
