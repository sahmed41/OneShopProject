<?php
    require_once("../_engine/_db_connect.php");

    // Collecting product filters
    $product_name = '%';
    $product_category = '%';
    $minimum_price = 0;
    $maximum_price =  0;
    $parameter = false;
    $api_key_validation = false;

    $products = array(); // Products will be stored in this array
    // Setting up disclaimer
    $disclaimer = array ("copyright"=>"2022",
        "discplaimer"=>"The information on the Service is provided with the understanding that the Company is not herein engaged in rendering legal, accounting, tax, or other professional advice and services. As such, it should not be used as a substitute for consultation with professional accounting, tax, legal or other competent advisers. In no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever arising out of or in connection with your access or use or inability to access or use the Service.",
        "contact us"=>"If you have any questions about this Disclaimer, You can contact Us By email: cb009072@students.apiit.lk"
    );  
    // Setting up status and disclaimer
    $output = array ("state"=>"fail",
        "disclaimer"=>$disclaimer
    );

    $db = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Assigning product filters from get variables    
    if (isset($_GET['product_name'])) {
        $product_name = $_GET['product_name'];
        $parameter = true;
    }
    
    if (isset($_GET['product_category'])) {
        $product_category = $_GET['product_category'];
        $parameter = true;
    }
    
    if (isset($_GET['minimum_price'])) {
        $minimum_price = $_GET['minimum_price'];
        $parameter = true;
    }
    
    if (isset($_GET['maximum_price'])) {
        $maximum_price = $_GET['maximum_price'];
        $parameter = true;
    }

    // validating api key
    if (isset($_GET['api_key'])) {
        $sql_key = "SELECT api_key FROM apikey WHERE api_key='" . $_GET['api_key'] . "'";
        $result_key = $db->query($sql_key);
        if ($result_key->num_rows == 1) {
            $api_key_validation = true;     
        } 
    }

    

    // Getting products from the database
    $sql = "SELECT * FROM products WHERE product_name LIKE '%" . $product_name. "%' AND Category LIKE '" . $product_category . "'"; 
    $result = $db->query($sql);
    if ($api_key_validation) {
        // This block will be executed only if the api key is correct
        if ($parameter) { 
            // This will be executed if the user passed parameters    
            if ($result->num_rows > 0) {
            // If the parameters match the database this block will be executed
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    if (($minimum_price > 0) and ($maximum_price == 0)) {
                        if ($row['product_price'] > $minimum_price) {
                            $product = array(
                                "product_name" => $row["product_name"],
                                "product_description" => $row['product_description'],
                                "product_price" => $row["product_price"],
                                "discsount" => $row["discsount"],
                                "Category" => $row["Category"],
                                "product_image" => $row["product_image"],
                                "added_on" => $row['added_on'],
                                "seller" => $row['seller']
                            );
                            array_push($products, $product);
                        }
        
                    } else if (($maximum_price > 0) and ($minimum_price == 0)) {
                        if ($row['product_price'] < $maximum_price) {
                            $product = array(
                                "product_name" => $row["product_name"],
                                "product_description" => $row['product_description'],
                                "product_price" => $row["product_price"],
                                "discsount" => $row["discsount"],
                                "Category" => $row["Category"],
                                "product_image" => $row["product_image"],
                                "added_on" => $row['added_on'],
                                "seller" => $row['seller']
                            );
                            array_push($products, $product);
                        }
                    } else if (($minimum_price > 0) and ($maximum_price > 0)) {
                        if (($row['product_price'] > $minimum_price) and ($row['product_price'] < $maximum_price)) {
                            $product = array(
                                "product_name" => $row["product_name"],
                                "product_description" => $row['product_description'],
                                "product_price" => $row["product_price"],
                                "discsount" => $row["discsount"],
                                "Category" => $row["Category"],
                                "product_image" => $row["product_image"],
                                "added_on" => $row['added_on'],
                                "seller" => $row['seller']
                            );
                            array_push($products, $product);
                        }
                    } else {
                        
                        $product = array(
                            "product_name" => $row["product_name"],
                            "product_description" => $row['product_description'],
                            "product_price" => $row["product_price"],
                            "discsount" => $row["discsount"],
                            "Category" => $row["Category"],
                            "product_image" => $row["product_image"],
                            "added_on" => $row['added_on'],
                            "seller" => $row['seller']
                        );
                        array_push($products, $product);
        
                    }
                    $output['state'] = "success";
                }   
            } else {
                // If the parameters don't match the database this block will be executed
                $products = array ("message" => "parameters don't match the available products");
            }
        } else {
            // This will be executed if the user does not pass any parameters
            $products = array ("message" => 'there should atleast be one parameter');    
        }
    } else {
        // This block will be executed if the api key is invalid
        $products = array ("message" => 'invalid api key');    

    }
    array_push($output, $products);
    $sql_log = "INSERT INTO api_log (api_name, used_key, time_of_access) VALUES ('product_api', '" . $_GET['api_key'] . "', '" .date("Y-m-d"). "' )";
    $db->query($sql_log); 

    header("Content-Type:application/json; charset=uft-8");
    echo json_encode($output);























    require_once("../_engine/_db_disconnect.php");
?>