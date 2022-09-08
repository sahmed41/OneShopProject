<?php
    session_start();
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $price = $_POST["price"];
    $discount = $_POST["discount"];
    $product_category = $_POST["product_category"];
    $product_image = md5($_POST["product_name"] . mt_rand()) . ".jpg";
    $added_on = date("Y/m/d");

    require_once('_db_connect.php');
    
    $sql = "INSERT INTO products ( product_name, product_description, product_price, discsount, Category, product_image, added_on, seller  )
    VALUES ('".$product_name."','".$product_description."','".$price."','".$discount."','".$product_category."','".$product_image."','" . $added_on .  "', '".$_SESSION['user_id']."')";

    if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
    
    
    $target_dir = "C:\\xampp\\htdocs\\resources\\pictures\\product_images\\";
    $target_file = $target_dir . basename($product_image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    move_uploaded_file($_FILES["product_image_main"]["tmp_name"], $target_file);
    
    header('Location: ../index.php?link=resources/pages/user_pages/inventory.php');
    require_once('_db_disconnect.php');
?>