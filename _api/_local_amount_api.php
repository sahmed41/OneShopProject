<?php

require_once('../_engine/_db_connect.php');
// GEO Loc Variables
// $latitude = "";
// $longitude = "";
$country = "";
$coords = false;
$conversion_info = false;


// IP variables
$ip_address = "";

// Common variables
$currency_from = "";
$currency_to = "";
$amount = "";
$api_key_validation= false;




// Getting the country id (Ex: LK) using geographic coordinations
function getCountryByGeo() {
    global $latitude, $longitude;
    $params=['lat'=>$latitude, 'lon'=>$longitude, "appid"=>'acb327a05e0b6a4f4815504a626b1733'];
    $endpoint = 'api.openweathermap.org/data/2.5/weather';
    $url = $endpoint . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $wresponse =  curl_exec($ch);
    
    $weather = json_decode($wresponse);    
    
    $country = $weather->sys->country;   
    
    return $country;
}

//  Getting the local currency of a visitor using the country id obtained using geographic coordination
function getLocalCurrency() {
    global $country;
    $local_country = $country;

    $headers = array (
        'Content-type: application/xml',
        'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
    );

    $params=['name'=>$local_country];
    $endpoint = 'https://country-by-api-ninjas.p.rapidapi.com/v1/country';
    $url = $endpoint . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $country =  curl_exec($ch);

    $country_information = json_decode($country);
    
    return $country_information[0]->currency->code;
    // echo $local_country;
}

// Convering the LKR to the visitors local currency to visitors local currency 
function convertCurrency() {
    global $currency_from, $currency_to, $amount;
    $from = $currency_from;
    $to = $currency_to; 
    $amount_to_convert = $amount;

    $headers = array (
        'Content-type: application/xml',
        'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
    );

    $params=['from'=>$from, 'to'=>$to, 'amount'=>$amount_to_convert];
    $endpoint = 'https://currency-converter13.p.rapidapi.com/convert';
    $url = $endpoint . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $convert_currency =  curl_exec($ch);

    $converted_currency = json_decode($convert_currency);
     
    return $converted_currency->amount;  
}

// Obtaining IP address, country code and local currency of a visitor
function getLocalCurrencyByIp() {
    $headers = array (
        'Content-type: application/xml',
        'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
    );

    // $params=['from'=>$from, 'to'=>$to, 'amount'=>$amount];
    $endpoint = 'https://ipgeolocation.abstractapi.com/v1/?api_key=24d6102e25d548cc9d1c1261c38380ab';
    $url = $endpoint;
    //  . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $info =  curl_exec($ch);

    $info_json = json_decode($info);
    // var_dump($converted_currency);

    
    // echo $info_json->ip_address . "<br>";
    return $info_json->currency->currency_code;
    
}

$disclaimer = array ("copyright"=>"2022",
    "discplaimer"=>"The information on the Service is provided with the understanding that the Company is not herein engaged in rendering legal, accounting, tax, or other professional advice and services. As such, it should not be used as a substitute for consultation with professional accounting, tax, legal or other competent advisers. In no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever arising out of or in connection with your access or use or inability to access or use the Service.",
    "contact us"=>"If you have any questions about this Disclaimer, You can contact Us By email: cb009072@students.apiit.lk"
);

$result = array ("state"=>"fail",
 "disclaimer"=>$disclaimer
);











if (isset($_GET['api_key'])) {

    $sql_key = "SELECT api_key FROM apikey WHERE api_key='" . $_GET['api_key'] . "'";
    $result_key = $db->query($sql_key);

    if ($result_key->num_rows == 1) {
        $api_key_validation = true;     
    } 

}

if ($api_key_validation) {
    // This block will be executed only if the correct api key is passed
    if (isset($_GET['lat']) and isset($_GET['lon'])) {
        // This block will be executed only if latitude and longitued are passed
        $latitude = $_GET['lat']; // Setting up geographic coordinates if they are passed and setting the value of coords to true
        $longitude = $_GET['lon']; // Setting up geographic coordinates if they are passed and setting the value of coords to true
        $country = getCountryByGeo();
        $currency_from = getLocalCurrency();
    } else {
        // This block will be executed only if no coordinates are passed
        $currency_from = getLocalCurrencyByIp(); // Setting up local currewncy if they geographic coordinates are not passed
    }
    
    if (isset($_GET['new_currency']) and isset($_GET['amount'])) {
        // This block will be executed if the new currency and amount is passed
        $currency_to = $_GET['new_currency'];
        $amount = $_GET['amount'];
        $amount = convertCurrency();
        $message = array ("Amount: "=> $amount);
        $result['state'] = 'success';
        array_push($result,$message);
    } else {
        // This block will be executed if new currency and/or amount is not passed
        $message = array ("Message: "=> "The new currency and/or amout was not passed");
        array_push($result,$message);
    }
} else {
    // This block will be executed if the api key is not passed or wrong
    $message = array ("Message: "=> "Invalid API Key");
    array_push($result,$message);

}

$sql_log = "INSERT INTO api_log (api_name, used_key, time_of_access) VALUES ('local_amount_api', '" . $_GET['api_key'] . "', '" .date("Y-m-d"). "' )";
$db->query($sql_log); 












// if (isset($_GET['api_key']) and $_GET['api_key'] == "1234") {
//     // This block will be executed only if the api key is correct
//     if ($conversion_info) {
//         // If the new currency and the amount is passed this block will be executed 
//         if ($coords) {
//             // Performing conversion using lattitude and longitude if the geographic coordinates are passed
//             $country = getCountryByGeo();
//             $currency_from =  getLocalCurrency();
//         } else {
//             // Performing conversion using ip address if the geographic coords ae not passed
//             $currency_from =  getLocalCurrencyByIp();
//         }
//         $result = array ("converted_amount" => convertCurrency()); 
//     } else {
//         // If the new currency and the amount is not passed this block will be executed
//         $result = array("message" => "New currency and the amount should be passed in order to perform the conversion");
//     }

// } else {
//     // This block will be executed if the api key is wrong 
//     $result = array("message" => "Invalid authentication!");
// }



header("Content-Type:application/json; charset=uft-8");

echo json_encode($result);

require_once('../_engine/_db_connect.php');




?>