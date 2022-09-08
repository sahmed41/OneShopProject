<div class="category_panel bg-dark text-light py-1 ms-2 my-2">
    <?php
    // Setting up category varialbe
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
    } else {
        $category = '%';
    }
    
    echo '<h2 class="ms-2 my-4 pb-2">Categories</h2>';
    echo '<ul>';
    if ($category == '%') {
        echo '<a class="link-info">All</a><br>';
    } else {
        echo '<a class="link-info">All</a><br>';
    }
    foreach ($product_categories as $product_category) {
        if ($category == $product_category) {
            echo '<a class="link-info">' . $product_category . '</a><br>';
        } else {
            echo '<a class="link-info">' . $product_category . '</a><br>';
        }
        // link=resources/pages/user_pages/inventory.php&
    }
    echo '</ul>';
    
    ?>
</div>