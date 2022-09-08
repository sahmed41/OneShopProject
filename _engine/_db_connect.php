<?php
    $servername = "localhost";
    $username = "oneshop";
    $password = "i4K%n6E#f3P&o^T*";
    $dbname = "oneshopdb";

    // Create connection
    $db = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
?>