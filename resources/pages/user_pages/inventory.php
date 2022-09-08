<?php
  $carousal_heading = "Inventory";
  require_once('resources\components\carousal.php');
?>
<div class="row inventory-viewport">
    <div class="col-2">
        <?php require_once('C:\xampp\htdocs\resources\components\category_panel_main.php') ?>
    </div>
    <div class="col-10">
        <div class="row">
            <div class="col-3">
                <?php require_once('resources\components\product_search.php'); ?>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#product_registration_form">Add Product</button>
            </div>
        </div>
        <div class="row my-3" id="inventory_page_display">
            <h1>Loading inventory...</h1>
            
        </div>
    </div>
</div>


<?php require_once('resources\forms\product_registration_form.php'); ?>    

