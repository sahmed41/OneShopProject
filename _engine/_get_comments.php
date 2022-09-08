<?php
session_start();


require_once("_db_connect.php");

$product = $_POST['product'];

$sql = "SELECT id, product, user, comment, added_date FROM comment WHERE product='" . $product . "'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<div class="bg-dark text-light my-2 p-2">';
    echo '<p class="com"><span class="fst-italic lh-lg">' . $row["comment"] . '</span><br>';

    // Taking user who posted the comment
     
    $sql_1 = "SELECT first_name, last_name FROM users WHERE user_id='" . $row['user'] . "'";
    $result_1 = $db->query($sql_1);

    if ($result_1->num_rows == 1) {
      // output data of each row
      $row_1 = $result_1->fetch_assoc();
      echo "<span>By: " . $row_1['first_name'] . " " . $row_1['last_name'] . "<span><br>";
    } else {
      echo '<p>User Id not valid</p>';
    }
    echo "<span>Added on: " . $row["added_date"] . "<span><br>";
    if ((isset($_SESSION['user_id'])) and $_SESSION['user_id'] == $row['user'] ) {
      echo '<a href="_engine/_delete_comment.php?id=' . $row['id'] . '&product=' . $row['product'] . '" class="link-light">Delete</a></span></p>';
    }
    echo '</div>';

  }
} else {
  echo '<p>No comments</p>';
}

require_once("_db_disconnect.php");

?>

