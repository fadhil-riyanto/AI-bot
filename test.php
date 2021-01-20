<?php
simi:
echo "Kamu :  ";
$input_nama = fopen("php://stdin", "r");
$nama = trim(fgets($input_nama));
// 65rRPWeiizNq8uNe-3hkyv7pPi.W58SUD8P5urK7
// X9QTrw5PpgtPTFZwS1PgR95JbYUvSJqCh03nRHim
// fAwvrgiIEL.F~k2~.-tXYQPtTgvA0JSqiWuFVbp9
// LMDTrTgTgqN3U8uKWWRAToems3..2wAaSJCeXnKW


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://wsapi.simsimi.com/190410/talk/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\n\t\"utext\": \". $nama .\", \n\t\"lang\": \"id\" \n}",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "x-api-key: 65rRPWeiizNq8uNe-3hkyv7pPi.W58SUD8P5urK7"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$simi = json_decode($response);
echo 'simi :  ' . $simi->atext . PHP_EOL;
goto simi;
