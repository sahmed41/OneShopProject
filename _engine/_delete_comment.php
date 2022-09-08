<?php
    require_once("_db_connect.php");

    // sql to delete a record
    $sql = "DELETE FROM comment WHERE id=" . $_GET['id'];

    if ($db->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $db->error;
    }

    header('Location: ../index.php?link=resources\pages\unique_pages\product.php&product_id=' . $_GET['product']);
    require_once("_db_disconnect.php");
?>