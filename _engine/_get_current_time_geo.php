<?php
   
$lat = $_GET['lat'];
$lon = $_GET['lon'];


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

echo $current_time;
    



   
        
   
    
        
    

        
   

?>