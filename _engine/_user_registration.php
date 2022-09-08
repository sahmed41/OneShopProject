<!-- Starting the session  -->
<?php session_start(); ?>
<?php
    require_once('_db_connect.php');

    // User verification
    // Getting user information for verification
    $sql_user_name = "SELECT first_name, last_name, location, contact_number, user_name, email, password FROM users WHERE user_name = '" . $_POST['user_name'] . "'";
    $sql_email = "SELECT first_name, last_name, location, contact_number, user_name, email, password FROM users WHERE email = '" . $_POST['email'] . "'";
    $db_user_name = $db->query($sql_user_name);
    $db_email = $db->query($sql_email);

    // 
    if ($db_user_name->num_rows > 0) {
        // Username verification
        echo "You have used an esisitng user name. Use a new user name and try again";
        echo '<br><a class="btn btn-danger" href="../index.php" role="button">Go Back</a>';
    } else if ($db_email->num_rows > 0) {
        // Email verification
        echo "You have used an esisitng email. Use a new email and try again";
        echo '<br><a class="btn btn-danger" href="../index.php" role="button">Go Back</a>';
    } else if ($_POST['password'] != $_POST['password_verification']) {
        // Password verification
        echo "Your passwords don not match";
        echo '<br><a class="btn btn-danger" href="../index.php" role="button">Go Back</a>';
    } else {
        // Registering new user
        $sql = "INSERT INTO users (first_name, last_name, location, contact_number, user_name, email, password, role) VALUES ('" . $_POST['first_name'] . "', '" . $_POST['last_name'] . "', '" . $_POST['location'] . "', '" . $_POST['contact_number'] . "', '" . $_POST['user_name'] . "', '" . $_POST['email'] . "', '" . md5($_POST['password']) . "','" . $_POST['privillage'] . "') ";
        if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
            header('../index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }    

        // User login
        session_start();
        session_destroy();
        session_unset();
        session_start();
        $_SESSION['user_id'] = $_POST['user_id'];
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['last_name'] = $_POST['last_name'];
        $_SESSION['location'] = $_POST['location'];
        $_SESSION['contact_number'] = $_POST['contact_number'];
        $_SESSION['user_name'] = $_POST['user_name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['role'] = $_POST['privillage'];

        header('Location: ../index.php');

    }
    // if ($db_user_name->num_rows > 0) {
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) {
    //         if ($_POST['user_name'] === $row['user_name']) {
    //             echo "There is another user with the same user name";
    //             break;
    //         } else if ($_POST['email'] === $row['email']) {
    //             echo "There is another user with the same email";
    //             break;
    //         } else if ($_POST['password'] === $_POST['password_verification']) {
    //             echo "Your passwords don't match";
    //             break;
    //         }
    //     }
    // } else {
    //     echo "0 results";
    // }
    // End of user verification

    require_once('_db_disconnect.php');
?>