<?php
    $location = $_GET['lat'] . ", " . $_GET['lon'];

    $headers = array (
        'Content-type: application/xml',
        'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
    );

    $params=['location'=>$location];
    $endpoint = 'https://geo-services-by-mvpc-com.p.rapidapi.com/timezone';
    $url = $endpoint . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $time_zone =  curl_exec($ch);

    $local_time_zone = json_decode($time_zone);

    $time = array (
        "current_time" =>  $local_time_zone->data->time_now
        
    );
    
    echo json_encode($time);
 ?>