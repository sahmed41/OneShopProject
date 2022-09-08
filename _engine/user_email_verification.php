<?php require_once("_db_connect.php") ?>

<?php $user_email = $_POST["user_email"]; ?>

<?php
$sql = "SELECT email FROM users";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    if ($user_email == $row["email"] ) {
        echo '<script> $("#user_email_register").val(\'\')</script>';
        echo '<p class="verification_error">The email ' . $user_email . ' already in use please use a different username.</p>';
    }
  }
} else {
  echo "0 results";
}
?>



<?php require_once("_db_disconnect.php") ?>

