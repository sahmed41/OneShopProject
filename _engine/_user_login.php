<?php
    require_once('_db_connect.php');

    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);

    $sql = "SELECT user_id, first_name, last_name, location, contact_number, user_name, email, password, role FROM users WHERE user_name = '$user_name' AND password = '$password' ";

    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        session_start();
        session_destroy();
        session_unset();
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['contact_number'] = $row['contact_number'];
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];        
        $_SESSION['role'] = $row['role'];
        // echo $_SESSION['user_id'] . "<br>";
        // echo $_SESSION['first_name'] . "<br>";
        // echo $_SESSION['last_name'] . "<br>";
        header('Location: ../index.php');
    } else {
        echo "Your user name or password is wrog. Retry";
        echo '<br><a class="btn btn-danger" href="../index.php" role="button">Go Back</a>';
    }
    


    require_once('_db_disconnect.php');
?>