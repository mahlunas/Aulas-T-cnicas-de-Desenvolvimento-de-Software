<div class="row">
  <div class="col-md-12 col-lg-12">
    <h4 class="mb-3">New user</h4>
    <form  action="index.php?controller=Product&action=update&id=<?php echo $product->getId ()?>" method="post">
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" placeholder="" value="<?php echo $product->getName ()?>" name="name" required>
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>


      <hr class="my-4">

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="offline">
        <label class="form-check-label" for="offline">Show this product if the system is offline??</label>
      </div>
      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" name="save" type="submit">Save</button>
    </form>
  </div>
</div>
