<?php
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];
    $params=['lat'=>$lat, 'lon'=>$lon, "appid"=>'acb327a05e0b6a4f4815504a626b1733'];
    $endpoint = 'api.openweathermap.org/data/2.5/weather';
    $url = $endpoint . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $wresponse =  curl_exec($ch);

    $weather = json_decode($wresponse);

    $weather_data = array (
        "country" =>  $weather->sys->country
        
    );


    
    echo json_encode($weather_data);
 ?>