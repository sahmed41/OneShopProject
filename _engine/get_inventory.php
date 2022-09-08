<?php 
    require_once('_db_connect.php');
    session_start();
    
    $search = $_POST['search'];
    $category = $_POST['category'];
    $currency = $_POST['currency'];
    $conversion_rate = $_POST['conversion_rate'];

    $sql = "SELECT product_id, product_name, product_description, product_price, discsount, category, product_image, added_on, seller FROM products WHERE seller ='" . $_SESSION['user_id'] ."' AND category LIKE '" . $category . "' AND product_name LIKE '%". $search ."%'";
    $result = $db->query($sql);

    
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // calculating the price if the discount is higher than 0 and printing the price message appropriately    
            if ((int)$row['discsount'] > 0) {
                // Calculating the price after discount
                $price = (int)$row["product_price"] - ((int)$row["product_price"] /100) * (int)$row['discsount'];
                
                    $price = $price * $conversion_rate;
                    $price = number_format((float)$price, 2, '.', '');
                
                $price_message = $price . ' ' . $currency . ' ' . $row['discsount'] . '% discount';
            } else {
                $price_message = $row["product_price"] . ' LKR';
            }
            // Displaying the products in the form of horizontal cards
            echo '<div class="row product_list">';
            echo     '<div class="col-9">';
            echo        '<div class="card mb-3 p-2" style="max-width: 1000px;">';
            echo            '<div class="row g-0">';
            echo                '<div class="col-md-4">';
            echo                    '<img src="resources/pictures/product_images/' . $row["product_image"] . '" class="img-fluid rounded-start" alt="...">';
            echo                '</div>';
            echo                '<div class="col-md-8 ps-2">';
            echo                    '<div class="card-body">';
            echo                        '<h5 class="card-title">' . $row["product_name"] . '</h5>';
            echo                        '<p class="card-text">' . $row["product_description"] . '</p>';
            echo                        '<p class="card-text">' . $price_message . '</p>';
            echo                        '<p class="card-text"><small class="text-muted">Added on ' . $row['added_on'] . '</small></p>';
            echo                    '</div>';
            echo                '<a type="button" class="btn btn-dark me-1" href="?link=resources\forms\product_editing_form.php&product_id='.$row['product_id'].'">Edit</a>';
            echo                '<a class="btn btn-dark" href="_engine/_product_delete.php?product_id='.$row['product_id'].'">Delete</a>';
            echo            '</div>';
            echo        '</div>';
            echo     '</div>';
            echo '</div>';
        } 
    } else {
        echo "<h2>You have not added any products matching this query.</h2>";
    }
    ?>
        
    </div>
</div>
<?php require_once('_db_disconnect.php'); ?>