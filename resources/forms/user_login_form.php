<div class="modal" tabindex="-1" id="exampleModalToggle">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="_engine/_user_login.php" method="POST" id="login_form">
        <div class="modal-body">
            <div class="mb-3">
                <label for="user_name_login" class="form-label" required>Username</label>
                <input type="text" class="form-control" id="user_name_login" name="user_name" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password_login" name="password" class="form-label" required>Password</label>
                <input type="password" class="form-control" id="password_login" name="password" required>
            </div>
            <div id="login_verification"></div>            
        </div>
        <div class="modal-footer">
            <input type="reset" value="Reset" class="btn btn-secondary">
            <button type="submit" class="btn btn-success" id="login_button">Submit</button>
        </div>
    </form>
    </div>
  </div>
</div>