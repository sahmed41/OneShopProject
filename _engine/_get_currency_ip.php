<?php
    // Taking the local currency using IP from ipgeolocation api by abstract api
    $headers_currency_code_ip = array (
        'Content-type: application/json',
        'x-rapidapi-key: 250389cc7fmsh0b99dcde0883ca9p1571aajsn324e91036b72'
    );

    $endpoint_currency_code_ip = 'https://ipgeolocation.abstractapi.com/v1/live/?api_key=24d6102e25d548cc9d1c1261c38380ab';
    $url_currency_code_ip = $endpoint_currency_code_ip;
    $ch_currency_code_ip = curl_init();
    curl_setopt($ch_currency_code_ip, CURLOPT_URL, $url_currency_code_ip);
    curl_setopt($ch_currency_code_ip, CURLOPT_HTTPHEADER, $headers_currency_code_ip);
    curl_setopt($ch_currency_code_ip, CURLOPT_RETURNTRANSFER, true);

    $info =  curl_exec($ch_currency_code_ip);

    $info_json = json_decode($info);

    $to = $info_json->currency->currency_code;
    $current_time = $info_json->timezone->current_time;


    // Converting the currency by using currency converter by not null
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
    
    $conversion_info = array(
        "local_currency" => $to,
        "conversion_rate" => $converted_currency->result->convertedAmount,
        "current_time" => $current_time
    );    
    // header("Content-Type:application/json; charset=uft-8");
    echo json_encode($conversion_info);  
?>
