<?php $sign_up_err_msg = "<p class='err_msg'>* missing</p>"; ?>
<div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="signUpModalLabel">Sign Up</h4>
	      </div>
	      <div class="modal-body">

	        <form role="form" method="post">
	          <div class="form-group">
			  	<label for="username_input">Username</label>
			  	<?php if(isset($signup_username_missing)) {if($signup_username_missing){ echo $sign_up_err_msg; }}?>
			    <?php if(isset($signup_username_unavailable)) {if($signup_username_unavailable){ echo "<p>* username has already been used<p>"; }}?>
			    <input type="text" name="username_input" class="form-control" id="username_input" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <label for="email_input">Email address</label>
			    <?php if(isset($signup_email_missing)) {if($signup_email_missing){ echo $sign_up_err_msg; }}?>
			    <?php if(isset($signup_email_unavailable)) {if($signup_email_unavailable){ echo "<p>* email has already been used<p>"; }}?>
			    <input type="email" name="email_input" class="form-control" id="email_input" placeholder="Enter email">
			  </div>
			  <div class="form-group">
			  	<label for="fname_input">First Name</label>
			  	<?php if(isset($signup_fname_missing)) {if($signup_fname_missing){ echo $sign_up_err_msg; }}?>
			    <input type="text" name="fname_input" class="form-control" id="fname_input" placeholder="First Name">
			  </div>
			  <div class="form-group">
			  	<label for="lname_input">Last Name</label>
			  	<?php if(isset($signup_lname_missing)) {if($signup_lname_missing){ echo $sign_up_err_msg; }}?>
			    <input type="text" name="lname_input" class="form-control" id="lname_input" placeholder="Last Name">
			  </div>
			  <div class="form-group">
			    <label for="pass_input">Password</label>
			    <?php if(isset($signup_pass_missing)) {if($signup_pass_missing){ echo $sign_up_err_msg; }}?>
			    <input type="password" name="pass_input" class="form-control" id="pass_input" placeholder="Password">
			  </div>
			  <input type="hidden" value="signup" name="account_action">

			  <button type="submit" class="btn btn-default">Submit</button>
			</form>

	      </div>
	    </div>
	  </div>