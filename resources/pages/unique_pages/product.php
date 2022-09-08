<?php
$product_id =  $_GET['product_id'];
$sql = "SELECT product_id, product_name, product_description, product_price, discsount, Category, product_image, added_on, seller FROM products WHERE product_id='" . $product_id . "'";



$result = $db->query($sql);
?>
<?php
    
?>

    
        
<?php
if ($result->num_rows == 1) {
  // output data of each row
  $row = $result->fetch_assoc();
  
  $carousal_heading = $row['product_name'];
  require_once('resources\components\carousal.php');

    if ((int)$row['discsount'] > 0) {
        // Calculating the price after discount
        $price = (int)$row["product_price"] -((int)$row["product_price"] /100) * (int)$row['discsount'];
        $price_message = $price . ' LKR after ' . $row['discsount'] . '% discount';
    } else {
        $price_message = $row["product_price"] . ' LKR';
    }
    echo '<div class="container">';
    echo '<div class="row my-3">';
    echo '<div class=col-12><h1>' . $row['product_name'] . '</h1></div>';
    echo '</div>';
    echo '<div class="row my-3">';
    echo '<div class="col-6">';
    echo '<img class="w-100 prodect_image" src="resources/pictures/product_images/'.$row['product_image'].'" class="img-fluid" alt="Image of the product">';
    echo '</div>';
    echo '<div class="col-6">';
        
        echo '<p class="h4"> Product Description: ' .$row['product_description']. '</p>';
        echo '<p class="h4"> Price: ' .$price_message. '</p>';
        echo '<p class="h4"> Category: ' .$row['Category']. '</p>';
        echo '<p class="h4"> Added: ' .$row['added_on']. '</p>';
    echo '</div>';
    echo '</div>';

    $sql_user = "SELECT contact_number, location FROM users WHERE user_id='" . $row['seller'] . "'";
    $result_user = $db->query($sql_user);

    // $row_user = $result_user->fetch_assoc();
    if ($result_user->num_rows == 1) {
        while ($row_user = $result_user->fetch_assoc()) {
            echo '<div class="product_contact p-2">';
            echo '<h2>Seller Contact Information</h2>';
            echo '<p class="h4">Seller Contact Number: ' .$row_user['contact_number'] . '</p>';
            echo '<p class="h4">Product Location: ' .$row_user['location'] . '</p>';
            echo '</div>';
        }
    }
    $seller = $row['seller']; // setting up seller for comment section
  
} else {
  echo "0 results";
}

?>

<script>
  var product_id = <?php echo $_GET['product_id']?>;
</script>

<?php if (isset($_SESSION['user_id'])) { ?>
<form action="_engine/_post_comment.php">
  <div class="form-floating mt-5">
    <input type="hidden" name="product" value=<?php echo $product_id ?>>
    <textarea class="form-control mb-1" placeholder="Leave a comment here" id="comment" maxlength="200" name="comment"></textarea>
    <label for="floatingTextarea">Comments</label>
    <button type="submit" class="btn btn-dark">Submit</button>
  </div>
</form>
<?php } ?>

<div id="comments">


</div>

        
        
    
</div>