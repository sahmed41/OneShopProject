<?php require_once("_db_connect.php") ?>

<?php 
// Assigning the login information to variables
$user_name = $_POST["user_name"]; 
$password = md5($_POST["password"]); 
?>

<?php
// Looking for entries in the database based on the login information
$sql = "SELECT user_name, password FROM users WHERE user_name = '$user_name' AND password = '$password' ";
$result = $db->query($sql);


if ($result->num_rows == 1) { // This block will be executed if the login information is founded on the database
    echo '<script>$("#login_form").unbind(\'submit\').submit()</script>'; 
} else { // This block will be executed if the login information is not founded on the database
    echo '<script> $("#user_name_login").val(\'\')</script>';
    echo '<script> $("#password_login").val(\'\')</script>';
    echo '<p class="verification_error">The user name or password is wrong please check your credentials again and retype.</p>';
}

?>


<?php require_once("_db_disconnect.php") ?>