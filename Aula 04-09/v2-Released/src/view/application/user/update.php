<div class="row">
  <div class="col-md-12 col-lg-12">
    <h4 class="mb-3">New user</h4>
    <form  action="index.php?controller=User&action=update&id=<?php echo $user->getId ()?>" method="post">
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="firstName" class="form-label">First name</label>
          <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $user->getName ()?>" name="name" required>
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>

        <div class="col-sm-6">
          <label for="lastName" class="form-label">Last name</label>
          <input type="text" class="form-control" id="lastName" placeholder="" value="" name="lastName" required>
          <div class="invalid-feedback">
            Valid last name is required.
          </div>
        </div>

        <div class="col-12">
          <label for="username" class="form-label">Username</label>
          <div class="input-group has-validation">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
          <div class="invalid-feedback">
              Your username is required.
            </div>
          </div>
        </div>

        <div class="col-12">
          <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->getEmail () ?>" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

      </div>

      <hr class="my-4">

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="same-address">
        <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
      </div>
      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" name="save" type="submit">Save</button>
    </form>
  </div>
</div>
