<!doctype html>
<!-- Starting the session  -->
<?php session_start(); ?> 
<html lang="en">
    <?php
        // Getting the Pge links for navigation bar
        if(isset($_GET['link'])) {
            $content = $_GET['link'];
        } else {
            $content = 'resources/pages/site_pages/0_home.php';
        }


        
    ?>
    
    
    <head>
        <!-- Required meta tags -->
        <?php require_once('resources/meta/meta.php')?>
        <?php require_once('resources/meta/styles.php')?>
        
        <title>One Shop</title>
    </head>
<body>
    <!-- Setting up the variables  -->
    <?php
        $product_categories = array("Computer", "Toys", "Appliances","Clothing", "Fitness", "Art & Culture"); // Setting up the product category
        $user_locations = array("Kandy", "Colombo", "Trincomalee","Galle"); // Setting up the location category

        // Setting up the page links
        $pages = glob('resources/pages/site_pages/*.php', GLOB_BRACE);
    ?>
    <?php require_once('_engine/_db_connect.php'); ?>

    <?php require_once('resources/components/navbar.php'); ?>
    <?php require_once($content); ?>    

    
    <?php require_once('resources/forms/user_login_form.php') ?>
    <?php require_once('resources/forms/user_registration_form.php') ?>

    

    

    <!-- 
        ehco '<div class="card" style="width: 18rem;">'
        echo    '<img src="..." class="card-img-top" alt="...">'
        echo    '<div class="card-body">'
        echo        '<h5 class="card-title">$row["product_name"]</h5>'
        echo        '<p class="card-text">$price $currency.</p>'
        echo        '<a href="#" class="btn btn-primary">Go somewhere</a>'
        echo    '</div>'
        echo '</div>'
     -->

     <!-- <?php echo $_SESSION['role'] ?> -->
    <?php require_once('_engine/_db_disconnect.php') ?>
    
    
    <?php require_once('resources/components/footer.php')?>
    <?php require_once('resources/meta/js.php')?>
    <?php
        if (isset($_GET['category'])) {
            echo '<script>';
            echo    'category = "' . $_GET['category'] . '"';
            echo    'load_products("#products_page_display",search, category, "_engine/_get_product.php" )';
            echo '</script>';
        }
    ?>


  </body>
</html>