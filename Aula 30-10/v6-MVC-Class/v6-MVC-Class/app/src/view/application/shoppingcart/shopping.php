<?php


?>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        <? 
        foreach ($products as $key => $product) : 
            if ($product->checkImage ()) : ?>

                <div class="col">
                <div class="card shadow-sm">
                    <a href="<?= $product->getLink ()?>"><img src="<?= $product->getImage ()?>" class="bd-placeholder-img card-img-top" height="200" ></a>
                    <div class="card-body">
                    <p class="card-text"><?= $product->getName ()?> <br> <?= $product->getDescription ()?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="index.php?controller=ShoppingCart&action=checkImageContent&id=<?= $product->getId ()?>" type="button" type="button" class="btn btn-sm btn-outline-secondary">Check</a>
                            <a href="index.php?controller=ShoppingCart&action=add&id=<?= $product->getId ()?>" type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</a>
                        </div>
                        <small class="text-body-secondary"><b>R$ <?= Product::formatPrice ($product->getPrice ())?></b></small>
                    </div>
                    </div>
                </div>
                </div>

            <? 
            endif;
        endforeach; ?>

      </div>
     <br>
      <p>
          <a href="index.php?controller=ShoppingCart&action=checkout" class="btn btn-primary my-2">Checkout</a>
          <a href="#" class="btn btn-secondary my-2">Empty</a>
        </p>
