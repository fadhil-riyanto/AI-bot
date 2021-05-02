<?php
$kon = @mysqli_connect(
    'b8rkwqqp7tbpt89flosy-mysql.services.clever-cloud.com',
    'uqirurwvstycdqcb',
    'Xsvy2C4BGmuDCqI3fSoa',
    'b8rkwqqp7tbpt89flosy'
);
$q = mysqli_query($kon, "SELECT * FROM `data_ai` WHERE `data_res_ai` LIKE _utf8 '' ");
$tes_jumlah_row = @mysqli_affected_rows($kon);
$dataAI = mysqli_fetch_assoc($q);
foreach ($q as $data_res_ai_val) {
    echo "===============" . PHP_EOL;
    echo "PERTANYAAN MYSQL: " . $data_res_ai_val['data_key_ai'] . PHP_EOL;
    echo "JAWABAN MYSQL: " . $data_res_ai_val['data_res_ai'] . PHP_EOL;
    $ggg = $data_res_ai_val['data_res_ai'];
    $hhh =  addslashes($data_res_ai_val['data_key_ai']);
    if (strlen($hhh) > 110) {
        //continue;
        echo "SKIPPED LONG CHARS" . PHP_EOL;
    } else {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.simsimi.net/v1/?text=" . urlencode($hhh) . "&lang=id");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $simi = json_decode($response);
        $c = addslashes($simi->success);
        if ($simi->success == 'Aku tidak mengerti apa yang kamu katakan.Tolong ajari aku.') {
            $c = "aku ngga ngerti apa yang kamu omongin... maap yak...";
        } else {
            echo "jAWABAN API : " . $c . PHP_EOL;
            //mysqli_query($kon, "UPDATE `b8rkwqqp7tbpt89flosy`.`data_ai` SET `data_res_ai`='" . $c . "' WHERE  `data_key_ai`='" . $hhh . "' AND `data_res_ai`='hmhm' LIMIT 1");
            mysqli_query($kon, "UPDATE `data_ai` SET `data_res_ai`='$c' WHERE  `data_key_ai`='$hhh' AND `data_res_ai`='' LIMIT 1");
            $tes_jumlah_roWSS = @mysqli_affected_rows($kon);
            echo "AFFECTED : " . $tes_jumlah_roWSS . PHP_EOL;
        }
    }
}
