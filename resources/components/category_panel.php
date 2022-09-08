<?php
    // Setting up category varialbe
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
    } else {
        $category = '%';
    }
    
    echo '<h2>Categories</h2>';
    echo '<ul>';
    if ($category == '%') {
        echo '<a class="link-info fw-bold" href=?link=resources/pages/user_pages/inventory.php&category=%>All</a><br>';
    } else {
        echo '<a class="link-info" href=?link=resources/pages/user_pages/inventory.php&category=%>All</a><br>';
    }
    foreach ($product_categories as $product_category) {
        if ($category == $product_category) {
            echo '<a class="link-info fw-bold" href=?link=resources/pages/user_pages/inventory.php&category=' . $product_category . '>' . $product_category . '</a><br>';
        } else {
            echo '<a class="link-info" href=?link=resources/pages/user_pages/inventory.php&category=' . $product_category . '>' . $product_category . '</a><br>';
        }
        // link=resources/pages/user_pages/inventory.php&
    }
    echo '</ul>';
?>