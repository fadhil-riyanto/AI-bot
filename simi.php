<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://afara.my.id/api/v3/sim-simi?text=kamu jelek",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    // CURLOPT_POSTFIELDS => "{\n\t\"utext\": \"hello there\", \n\t\"lang\": \"en\" \n}",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Connection: keep-alive",
        "Authorization: Bearer YhPPM-0A1uE-xtGTr-pvXSq"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
