<?php
    $country = $_GET['name'];

    $headers = array (
        'Content-type: application/xml',
        'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
    );

    $params=['name'=>$country];
    $endpoint = 'https://country-by-api-ninjas.p.rapidapi.com/v1/country';
    $url = $endpoint . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $country =  curl_exec($ch);

    $country_information = json_decode($country);
    
    $country_currency = array (
        "currency" =>  $country_information[0]->currency->code
        
    );
    
    echo json_encode($country_currency);
 ?>