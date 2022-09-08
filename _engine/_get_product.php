<?php require_once("_db_connect.php") ?>
<?php  
    // Setting up post variables
    $search = $_POST['search'];
    $category = $_POST['category'];
    $currency = $_POST['currency'];
    $conversion_rate = $_POST['conversion_rate'];

    // Importing the products from the database
    $sql = "SELECT product_id, product_name, product_description, product_price, discsount, Category, product_image, added_on, seller FROM products WHERE Category LIKE '" . $category . "' AND product_name LIKE '%" . $search . "%'";
    $result = $db->query($sql);

    
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // calculating the price if the discount is higher than 0 and printing the price message appropriately    
            if ((int)$row['discsount'] >= 0) {
                // Calculating the price after discount
                $price = (int)$row["product_price"] - ((int)$row["product_price"] /100) * (int)$row['discsount'];
                $price = $price * $conversion_rate;
                $price = number_format((float)$price, 2, '.', '');
                $price_message = $price . ' ' . $currency . ' after ' . $row['discsount'] . '% discount';
            } else {
                $price_message = $row["product_price"] . ' ' . $currency;
            }

            // Displaying the products in the form of  cards  
            echo '<div class="col-3 my-2">';          
                echo '<div class="card text-light bg-dark" style="width: 18rem;">';
                    echo '<img src="resources/pictures/product_images/' . $row['product_image'] . '" class="card-img-top product_image" alt="product_image">';
                    echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['product_name'] . '</h5>';
                        echo '<p class="card-text">' . $price_message . '</p>';
                        echo '<a class="btn btn-outline-light" href="?link=resources\pages\unique_pages\product.php&product_id=' . $row['product_id']. '">More</a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            

        }
            
        
    } else {
        // output the product not updated yet according to category
        echo '<h2>Sorry we do not have the product(s) you are looing for.</h2>';
    }
?>

<?php require_once("_db_disconnect.php") ?>