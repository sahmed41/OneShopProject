<?php require_once("_db_connect.php") ?>

<?php $user_name = $_POST["user_name"] ?>

<?php
$sql = "SELECT user_name FROM users";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    if ($user_name == $row["user_name"] ) {
        echo '<script> $("#user_name_register").val(\'\')</script>';
        echo '<p class="verification_error">The user name ' . $user_name . ' is already in use please use a different username.</p>';
    }
  }
} else {
  echo "0 results";
}
?>



<?php require_once("_db_disconnect.php") ?>


