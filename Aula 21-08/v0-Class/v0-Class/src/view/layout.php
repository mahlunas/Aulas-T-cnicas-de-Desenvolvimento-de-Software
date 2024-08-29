<!doctype html>
<html lang="en" data-bs-theme="auto">

  <?php Renderer::header(); ?>

  <body class="bg-body-tertiary">

    <?php Renderer::mode(); ?>

    <div class="container">

      <main>
        <div class="py-5 text-center">
          <img class="d-block mx-auto mb-4" src="assets/brand/ufms_logo.png" alt="" >
          <h2>Advanced Software Development Techniques</h2>
          <p class="lead">Practical class on the implementation of the MVC architectural model</p>
        </div>

        <?php Renderer::page(); ?>

      </main>

        <?php Renderer::footer(); ?>

    </div>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
