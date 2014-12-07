<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="loginModalLabel">Log In</h4>
  </div>
  <div class="modal-body">
    <form role="form" method="post">
        <div class="form-group">
          <label for="username_input">Email or Username</label>
          <input type="text" name="name_input" class="form-control" id="name_input" placeholder="Email or Username">
        </div>
        <div class="form-group">
          <label for="pass_input">Password</label>
          <input type="password" name="pass_input" class="form-control" id="pass_input" placeholder="Password">
        </div>
        <input type="hidden" value="login" name="account_action">

        <button type="submit" class="btn btn-default">Submit</button>
      </form>
  </div>
</div>
</div>