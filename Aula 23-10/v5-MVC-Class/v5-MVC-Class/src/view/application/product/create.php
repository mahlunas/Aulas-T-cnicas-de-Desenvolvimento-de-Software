<div class="row">
  <div class="col-md-12 col-lg-12">
    <h4 class="mb-3">New Product</h4>
    <form  action="index.php?controller=Product&action=create" method="post">
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" placeholder="" value="" name="name" required>
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
        <div class="col-sm-6">
          <label for="price" class="form-label">Price</label>
         <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" placeholder="0.00" required>
          <div class="invalid-feedback">
            Price is required.
          </div>
        </div>
        <div class="col-12">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" placeholder="" value="" name="description" required></textarea>
          <div class="invalid-feedback">
            Description is required.
          </div>
        </div>
      </div>

      <hr class="my-4">

      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="offline">
        <label class="form-check-label" for="offline">Product available?</label>
      </div>
      <hr class="my-4">

      <button class="w-100 btn btn-primary btn-lg" name="save" type="submit">Save</button>
    </form>
  </div>
</div>
