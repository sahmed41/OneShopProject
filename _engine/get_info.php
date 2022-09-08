<?php
    // Getting ip address, current time and currency information
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

    $info_api = array (
        "ip" =>  $info_json->ip_address,
        "current_time" => $info_json->timezone->current_time,       
        "currency" => $info_json->currency->currency_code       
    );
    
    // echo json_encode($info_api);

    $from = 'lkr';
    $to = $info_api["currency"];
    $amount = '1';
    $headers = array (
        'Content-type: application/xml',
        'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
    );

    $params=['from'=>$from, 'to'=>$to, 'amount'=>$amount];
    $endpoint = 'https://currency-converter13.p.rapidapi.com/convert';
    $url = $endpoint . '?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $convert_currency =  curl_exec($ch);

    $converted_currency = json_decode($convert_currency);
    // var_dump($converted_amount);

    $info_api["amount"] = $converted_currency->amount;
    
    echo json_encode($info_api);

 ?>
  