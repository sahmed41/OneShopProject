<!-- Starting the session  -->
<?php session_start(); ?>
<?php require_once('_db_connect.php'); ?>


<?php
    // Capturing Post variables in regular variables
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $product_category = $_POST['product_category'];

    if (($_FILES['product_image']['name']) == "") {
        $product_image = $_GET['product_image'];
    } else {
        $product_image = md5($_POST["product_name"] . mt_rand()) . ".jpg";
    }

    // echo $product_id;
    // SQL for updating recoreds 
    $sql = "UPDATE products SET product_name ='" . $product_name . "' , product_description ='" . $product_description . "' , product_price ='" . $price . "' , discsount ='" . $discount . "' , Category ='" . $product_category . "' , product_image ='" . $product_image . "' WHERE product_id ='" . $product_id . "'";

    if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
    } else {
    echo "Error updating record: " . $db->error;
    }
   
    var_dump($_FILES['product_image']['name']);
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
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
    header('Location: ../index.php?link=resources/pages/user_pages/inventory.php'); //redirecting to inventory
?>

<?php require_once('_db_disconnect.php') ?>