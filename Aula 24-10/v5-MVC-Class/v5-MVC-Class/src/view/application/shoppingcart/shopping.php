

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <? 
        
        foreach ($products as $key => $product) : ?>

        <div class="col">
          <div class="card shadow-sm">
            <img src="assets/img/product<?= rand(1, 6); ?>.jpg" class="bd-placeholder-img card-img-top" width="100%" >
            <div class="card-body">
              <p class="card-text"><h3><?= $product->getName ()?></h3><?= $product->getDescription ()?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <a href="index.php?controller=ShoppingCart&action=add&id=<?= $product->getId ()?>" type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</a>
                </div>
                <small class="text-body-secondary">R$ <?= Product::formatPrice ($product->getPrice ())?></small>
              </div>
            </div>
          </div>
        </div>

        <? endforeach; ?>

      </div>
     <br>
      <p>
          <a href="index.php?controller=ShoppingCart&action=checkout" class="btn btn-primary my-2">Checkout</a>
          <a href="#" class="btn btn-secondary my-2">Empty</a>
        </p>
