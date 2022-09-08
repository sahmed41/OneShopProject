<?php 
    require_once("../_engine/_db_connect.php");

    
    if (isset($_GET['api_key'])) {
        $sql_key = "SELECT api_key FROM apikey WHERE api_key='" . $_GET['api_key'] . "'";
        $result_key = $db->query($sql_key);
        if ($result_key->num_rows == 1) {
            $verification = true;     
        } else {
            $verification = false;     
        }
    } else {
        $verification = false;
    }

    // Setting up disclaimer
    $disclaimer = array ("copyright"=>"2022",
        "discplaimer"=>"The information on the Service is provided with the understanding that the Company is not herein engaged in rendering legal, accounting, tax, or other professional advice and services. As such, it should not be used as a substitute for consultation with professional accounting, tax, legal or other competent advisers. In no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever arising out of or in connection with your access or use or inability to access or use the Service.",
        "contact us"=>"If you have any questions about this Disclaimer, You can contact Us By email: cb009072@students.apiit.lk"
    );  
    // Setting up status and disclaimer
    $output = array ("state"=>"fail",
        "disclaimer"=>$disclaimer
    );

    
	


    if ($verification) {
        if (isset($_POST['email']) and isset($_POST['password'])) {
            $user_email = $_POST['email'];
            $password = md5($_POST['password']);
            
            $sql = "SELECT first_name, last_name, location, contact_number, user_name, email FROM users WHERE email = '" . $user_email . "' AND password = '" . $password . "'";
            $result = $db->query($sql);
        
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $authentication = array (
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "location" => $row['location'],
                    "contact_number" => $row['contact_number'],
                    "user_name" => $row['user_name'],
                    "email" => $row['email']
                );
                $output['state'] = "success";
            } else {
                $authentication = array ("message" => "Authentication failiure: the email and/or password doesn't match our database entries");
            }
        } else {
            $user_email = 'xxxxxx'; // purpose of this variable is to prevent undefined variable error 
            $password = 'xxxxxx'; // purpose of this variable is to prevent undefined variable error 
            $authentication = array ("message" => "The email and password must be provided");
        }
    
        // $user_email = 'sahmed@email.com';
        // $password = "2a0166c4bd9a17a69a53de146d4a67f4";
    
    
        

    } else {
        $authentication = array("message" => "Invalid API key!");
    }

$sql_log = "INSERT INTO api_log (api_name, used_key, time_of_access) VALUES ('login_api', '" . $_GET['api_key'] . "', '" .date("Y-m-d"). "' )";
$db->query($sql_log); 

    array_push($output, $authentication);
    header("Content-Type:application/json; charset=uft-8");
    echo json_encode($output);
    
    require_once("../_engine/_db_disconnect.php");
?>