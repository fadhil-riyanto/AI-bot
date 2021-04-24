<?php
$hhh = "hai";
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
            "x-api-key: KcQVuHLSRW1zrqK06fDJDVl-1z7iJy_levUIEbrz"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
	
	echo $response;