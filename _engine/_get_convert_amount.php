<?php
    // $from = $_GET['from'];
    // $to = $_GET['to'];
    // $amount = $_GET['amount'];
    
    $from = 'lkr';
    $to = 'eur';
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

    $converted_amount = array (
        "amount" =>  $converted_currency->amount        
    );
    
    echo json_encode($converted_amount);
 ?>