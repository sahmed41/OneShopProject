<!-- Product Page -->
<?php
$carousal_heading = "Products";
require_once('resources/components/carousal.php');
?>
 <div class="row w-100">
    <div class="col-2">
        <?php require_once('resources/components/category_panel_main.php') ?>
    </div>
    <div class="col-10 px-0">
        <div class="row">
            <div class="col-3">
                <!-- <div class="input-group my-3 w-25">
                    <input type="text" class="form-control" id="products_page_search_input" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-dark" id="products_page_search_button" type="button" id="button-addon2">Search</button>
                </div> -->
                <?php require_once('resources\components\product_search.php'); ?>

            </div>
        </div>
        <div class="row" id="products_page_display">
            <h1>Loading product....</h1>
        </div>
    </div>
</div>



