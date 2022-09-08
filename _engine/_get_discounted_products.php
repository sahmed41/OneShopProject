<?php
    require_once('_db_connect.php');
    $currency = $_POST['currency'];
    $conversion_rate = $_POST['conversion_rate'];
    $sql = "SELECT product_id, product_name, product_image, discsount, product_price, seller FROM products WHERE discsount > 4";
    $result = $db->query($sql);

    echo '<div class="row">';

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // echo "id: " . $row["product_id"]. "<br>Product Name: " . $row["product_name"]. "<br>Price " . $row["product_price"]. "<br>" . $row["discsount"] . "<br>";
            if ($row['discsount'] >= 5) {
                $price = $row["product_price"];
                $price = (int)$row["product_price"] - ((int)$row["product_price"] /100) * (int)$row['discsount'];
                $price = $price * $conversion_rate;                
                $price = number_format((float)$price, 2, '.', '');
                echo '<div class=col-3>';
                echo     '<div class="card my-3" style="width: 18rem;">';
                echo        '<img src="resources/pictures/product_images/' . $row['product_image'] . '" class="card-img-top" alt="...">';
                echo        '<div class="card-body">';
                echo            '<h5 class="card-title">' . $row["product_name"] . '</h5>';
                echo            '<p class="card-text">' . $price . ' ' . $currency. ' ' . 'after ' . $row['discsount']. '% discount</p>';
                echo            '<a href="?link=resources\pages\unique_pages\product.php&product_id=' . $row['product_id'] . '" class="btn btn-dark">More info</a>';
                echo        '</div>';
                echo     '</div>';
                echo '</div>';
            }
            
        }
    } else {
        echo "0 results";
    }
    echo '</div>';
    require_once('_db_disconnect.php');
?>
