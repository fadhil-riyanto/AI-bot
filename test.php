<?php
$udahDiparse = 'Maluku Utara';
$a_provinsi_corona = file_get_contents('https://api.kawalcorona.com/indonesia/provinsi/');
$b_provinsi_corona = json_decode($a_provinsi_corona);
foreach ($b_provinsi_corona as $bb_b_provinsi_corona) {
    if ($bb_b_provinsi_corona->attributes->Provinsi == $udahDiparse) {
        // echo $bb_b_provinsi_corona->attributes->Provinsi;
        // echo $bb_b_provinsi_corona->attributes->Kode_Provi;
        $reply = 'Provinsi : ' . $bb_b_provinsi_corona->attributes->Provinsi . PHP_EOL . PHP_EOL .
            '😊 Total sembuh : ' . $bb_b_provinsi_corona->attributes->Kasus_Semb . PHP_EOL .
            '😞 Total positif : ' . $bb_b_provinsi_corona->attributes->Kasus_Posi . PHP_EOL .
            '😢 Total meninggal : ' . $bb_b_provinsi_corona->attributes->Kasus_Meni . PHP_EOL;
        echo $reply;
    } else {
        $reply = 'elses';
    }
}
