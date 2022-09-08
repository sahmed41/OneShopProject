<!-- Starting the session  -->
<?php session_start(); ?>

<?php require_once('_db_connect.php'); ?>
<?php echo $_GET['product_id']; ?>

<?php 

    $sql = "DELETE FROM products WHERE product_id='" . $_GET['product_id'] . "'";

    if ($db->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $db->error;
    }

?>

<?php require_once('_db_disconnect.php') ?>
<?php header('Location: ../index.php?link=resources/pages/user_pages/inventory.php'); //redirecting to inventory ?>