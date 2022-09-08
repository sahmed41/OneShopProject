<?php
session_start();
require_once("_db_connect.php");

$user = $_SESSION['user_id'];
$appid = $_GET['app_id'];
$key =  md5($_SESSION['user_name'] . $_SESSION['user_id'] . $appid);
$date = date('Y-m-d');


$sql = "INSERT INTO apikey (user, app_id, api_key, created_date)
VALUES ('" . $user . "', '" . $appid . "' ,'" . $key . "', '" . $date . "')";

if ($db->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $db->error;
}


header('Location: ../index.php?link=resources/pages/site_pages/4_aPI.php');

require_once("_db_disconnect.php");
?>