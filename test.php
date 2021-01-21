<?php
$kon = @mysqli_connect(
    'freedb.tech',
    'freedbtech_ai_bot_fadhil_riyanto',
    '789b697698hyufijbbiub*&^BO&it87tbn7to&^7896',
    'freedbtech_ai_bot_fadhil_riyanto'
);
$q = mysqli_query($kon, "SELECT * FROM `data_ai` WHERE `data_res_ai` LIKE _utf8 'hmhm' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);
$dataAI = mysqli_fetch_assoc($q);
foreach ($q as $data_res_ai_val) {
    echo $data_res_ai_val['data_res_ai'];
    $ggg = $data_res_ai_val['data_res_ai'];
    $hhh =  $data_res_ai_val['data_key_ai'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://wsapi.simsimi.com/190410/talk/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\t\"utext\": \". $hhh .\", \n\t\"lang\": \"id\" \n}",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: X9QTrw5PpgtPTFZwS1PgR95JbYUvSJqCh03nRHim"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $simi = json_decode($response);
    $c = $simi->atext;
    if (@$simi->message == 'Limit Exceeded Exception') {
        //kita pakai api yg ini lah bang
        echo 'simi  :  prebarui api key!' . PHP_EOL;
        exit;
    } else {
        mysqli_query($kon, "UPDATE `data_ai` SET `data_res_ai`='$c' WHERE  `data_key_ai`='$hhh' AND `data_res_ai`='hmhm' LIMIT 1");
    }
}
