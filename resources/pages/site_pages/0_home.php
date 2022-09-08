<!-- Home Page Start -->
<!-- Setting up variable with Carousal values -->
<div class="home_page_heading">
<?php
$carousal_heading = "Welcome";
$carousal_message = "Please browse our collection of different products of different categories and locations. Choose the products you love, contact the seller and make a purchase.";
?>
<!-- Importing corousal to home page -->
<div id="home_carousal">
    <?php require_once('resources/components/carousal.php'); ?> 
</div>

</div>
    <div class="container my-3">  

        <div class="row">
            <h2>Explore some of our categories</h2>
        </div>
        <div class="row my-2">
        <?php
            $line_counter = 0;
            // Printing the product categories in the home page.
            foreach ($product_categories as $category) {
                echo '<div class="col-3">';
                echo    '<a class="home_page_category bg-dark text-light align-middle" href="?link=resources/pages/site_pages/3_products.php&category=' . $category . '">'; // The link for the product page and category is pass on click
                echo        '<p>' . $category . '</p>';
                echo     '</a>';
                echo '</div>';
                $line_counter++;

                if (($line_counter % 4) == 0) {
                    echo '</div><div class="row my-2">';
                } elseif ($line_counter == count($product_categories)) {
                    echo '</div>';
                }
            }

        ?>
        <div class="row">
            <h2 class="mt-5">Enjoy our awesome deals</h2>
        </div>
        <div id="home_page_deals">            
            <h1>Loading deals....</h1>
        </div>
    </div>
</div>