<?php

    require_once("_db_connect.php");

    session_start();
    echo $_GET['comment'];
    echo $_GET['product'];
    echo $_SESSION['user_id'];

    	
	

    $sql = "INSERT INTO comment (product, user, comment, added_date) VALUES ('" . $_GET['product'] . "', '" . $_SESSION['user_id'] . "', '" . $_GET['comment'] . "', '" . date("Y-m-d") . "')";

    if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    
    header('Location: ../index.php?link=resources\pages\unique_pages\product.php&product_id=' . $_GET['product'] );
    require_once("_db_disconnect.php");

    

?>