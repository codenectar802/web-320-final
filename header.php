<div class="container">
	<div class="header_menu">
		<ul class="nav navbar-nav main-nav pull-right">
			<?php
				if ($user_login_manager->logged_in == True) {
					echo "<li class='username_display'><h3>".$user_login_manager->user->get_fullname()."</h3></li>";
					echo "<li>|</li>";
					echo "<li><a class='btn btn-default' id='logout_link' data-toggle='modal' data-target='#logoutModal'>Log Out</a></li>";
				} elseif ($user_login_manager->logged_in == False) {
					echo "<li>
								<a class='btn btn-default' id='login_link' data-toggle='modal' data-target='#loginModal'>
									Log In
								</a>
							</li>
				          <li><a class='btn btn-default' id='signup_link' data-toggle='modal' data-target='#signUpModal'>Sign Up</a></li>";
				} else {
					echo "<li>We have an issue</li>";
				}
			?>
        </ul>
        <div class="logo_container">
			<h1>Conscious Games</h1>
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
<hr>
