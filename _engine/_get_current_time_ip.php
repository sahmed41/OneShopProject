<?php 
// Getting the current time using ip address
$headers_current_time_ip = array (
    'Content-type: application/xml',
    'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
);

// $params=['from'=>$from, 'to'=>$to, 'amount'=>$amount];
$endpoint_current_time_ip = 'https://ipgeolocation.abstractapi.com/v1/?api_key=24d6102e25d548cc9d1c1261c38380ab';
$url_current_time_ip = $endpoint_current_time_ip;
//  . '?' . http_build_query($params);
$ch_current_time_ip = curl_init();
curl_setopt($ch_current_time_ip, CURLOPT_URL, $url_current_time_ip);
curl_setopt($ch_current_time_ip, CURLOPT_HTTPHEADER, $headers_current_time_ip);
curl_setopt($ch_current_time_ip, CURLOPT_RETURNTRANSFER, true);

$info =  curl_exec($ch_current_time_ip);

$info_json = json_decode($info);
// var_dump($converted_currency);

$current_time = $info_json->timezone->current_time;   

echo $current_time;

?>
       