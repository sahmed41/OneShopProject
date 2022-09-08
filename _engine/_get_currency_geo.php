<?php

// $lat = "7.2";
// $lon = "80.5";
$lat = $_GET['lat'];
$lon = $_GET['lon'];

// Getting country code using open weather map api by passing geo location
$params=['lat'=>$lat, 'lon'=>$lon, "appid"=>'acb327a05e0b6a4f4815504a626b1733'];
$endpoint = 'api.openweathermap.org/data/2.5/weather';
$url = $endpoint . '?' . http_build_query($params);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$wresponse =  curl_exec($ch);

$weather = json_decode($wresponse);

$country_code =  $weather->sys->country;

// Get currency code using the country code obtained from openweathermap from country api by api-ninjas
$headers_currency_code = array (
    'Content-type: application/xml',
    'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
);

$params_currency_code=['name'=>$country_code];
$endpoint_currency_code = 'https://country-by-api-ninjas.p.rapidapi.com/v1/country';
$url_currency_code = $endpoint_currency_code . '?' . http_build_query($params_currency_code);
$ch_currency_code = curl_init();
curl_setopt($ch_currency_code, CURLOPT_URL, $url_currency_code);
curl_setopt($ch_currency_code, CURLOPT_HTTPHEADER, $headers_currency_code);
curl_setopt($ch_currency_code, CURLOPT_RETURNTRANSFER, true);

$country =  curl_exec($ch_currency_code);

$country_information = json_decode($country);

$currency_code = $country_information[0]->currency->code;

$to = $currency_code;


// Get converted amout using the currency code obtained from country api by api ninja from Currency Converter By not null
$headers_currency_converter = array (
    'Content-type: application/xml',
    'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
);

$params_currency_converter=['from'=>'lkr', 'to'=>$to, 'amount'=>'1'];
$endpoint_currency_converter = 'https://currency-converter18.p.rapidapi.com/api/v1/convert';
$url_currency_converter = $endpoint_currency_converter . '?' . http_build_query($params_currency_converter);
$ch_currency_converter = curl_init();
curl_setopt($ch_currency_converter, CURLOPT_URL, $url_currency_converter);
curl_setopt($ch_currency_converter, CURLOPT_HTTPHEADER, $headers_currency_converter);
curl_setopt($ch_currency_converter, CURLOPT_RETURNTRANSFER, true);

$convert_currency =  curl_exec($ch_currency_converter);

$converted_currency = json_decode($convert_currency);
// var_dump($converted_amount);




// Get current time from GEO Services by MVPC.com By MVPC.com using geo location
$location = $lat . ", " . $lon;

$headers_current_time = array (
    'Content-type: application/xml',
    'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
);

$params_current_time=['location'=>$location];
$endpoint_current_time = 'https://geo-services-by-mvpc-com.p.rapidapi.com/timezone';
$url_current_time = $endpoint_current_time . '?' . http_build_query($params_current_time);
$ch_current_time = curl_init();
curl_setopt($ch_current_time, CURLOPT_URL, $url_current_time);
curl_setopt($ch_current_time, CURLOPT_HTTPHEADER, $headers_current_time);
curl_setopt($ch_current_time, CURLOPT_RETURNTRANSFER, true);

$time_zone =  curl_exec($ch_current_time);

$local_time_zone = json_decode($time_zone);

$current_time = $local_time_zone->data->time_now;

$conversion_info = array(
    "local_currency" => $to,
    "conversion_rate" => $converted_currency->result->convertedAmount,
    "current_time" => $current_time
);  


echo json_encode($conversion_info);   

    
   

?>