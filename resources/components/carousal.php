<div class="position-relative overflow-hidden p-3 p-md-5 text-center text-light page_heading">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
    <h1 class="display-4 fw-normal" id="welcome_message"><?php echo $carousal_heading ?></h1> <!-- Printing Carousal heading -->
    <!-- Printing a message only if it exists -->
    <?php
    if (isset($carousal_message)) {
      echo '<p class="lead fw-normal">' . $carousal_message .'</p>'; // Printing Carousal message
    }

    // Verifying that it is the home page so the button can be printed     
    if ($content == 'resources/pages/site_pages/0_home.php') {
      echo '<a class="btn btn-outline-light" href="?link=resources/pages/site_pages/3_products.php">Browse Products</a>';
    }
    ?>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>