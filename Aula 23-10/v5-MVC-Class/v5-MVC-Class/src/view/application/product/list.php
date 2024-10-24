<div class="row">

  <div class="col-md-12 col-lg-12 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-primary">Products</span>
      <span class="badge bg-primary rounded-pill"><?php echo sizeof($products) ?></span>
    </h4>
    <ul class="list-group mb-3">
      <?php
      foreach ($products as $product) : ?>

        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0"><?php echo $product->getName () ?></h6>
            <small class="text-body-secondary"> R$ <?php echo Product::formatPrice($product->getPrice ()) ?></small>
          </div>
          <span class="text-body-secondary">

            <div class="btn-group">
              <a href="index.php?controller=User&action=update&id=<?php echo $product->getId ()?>" class="btn btn-outline-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                </svg>
                <span class="visually-hidden">Button</span>
              </a>
              <a href="index.php?controller=User&action=delete&id=<?php echo $product->getId ()?>" class="btn btn-outline-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                  </svg>
                <span class="visually-hidden">Button</span>
              </a>

            </div>

          </span>
        </li>

      <?php endforeach; ?>

    </ul>

    <div class="input-group">
      <a href="index.php?controller=Product&action=create" class="btn btn-success">Add Product</a>
    </div>

  </div>

</div>
