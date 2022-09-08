<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Registration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form action="_engine/_user_registration.php" method="POST" class="mt-2" id="user_registration_form">
      <div class="modal-body">
      <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" idate="location" name="location" required>
                    <option value="" selected required>Select a Location</option>
                    <?php
                        foreach ($user_locations as $location) {
                            echo '<option value="' . $location . '">' . $location . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="contact_number" name="contact_number" pattern="[0-9]{1,}-[0-9]{2}-[0-9]{4}-[0-9]{3}" placeholder="0049-11-1111-111" required>
            </div>
            <div class="mb-3">
                <label for="user_name_register" class="form-label">User Name</label>
                <input type="text" class="form-control" id="user_name_register" name="user_name" required>
            </div>
            <!-- Radio button -->
            <p>Privilage</p>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="privillage" id="privillage_seller" value="seller">
            <label class="form-check-label" for="privillage_seller">Seller</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input form-check-inline" type="radio" name="privillage" id="privillage_buyer" value="buyer" checked >
            <label class="form-check-label" for="privillage_buyer">Buyer</label>
            <!-- ------------------------------------------------------------------------------ -->
          </div>
            <div id="user_name_check"></div>
            <div class="mb-3">
                <label for="emuser_email_registerail" class="form-label">Email</label>
                <input type="email" class="form-control" id="user_email_register" name="email" required>
            </div>
            <div id="email_check"></div>
            <div class="mb-3">
                <label for="password_user_registration" class="form-label">password</label>
                <input type="password" class="form-control" id="password_user_registration" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_verification_user_registration" class="form-label">Re-type Password</label>
                <input type="password" class="form-control" id="password_verification_user_registration" name="password_verification" required>
            </div>
            <div id="password_check_user_registration"></div>
      </div>
      <div class="modal-footer">
        <input type="reset" class="btn btn-secondary">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
