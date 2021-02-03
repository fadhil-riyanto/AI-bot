<?php
require __DIR__ . '/../vendor/autoload.php';
$headers = array('Accept' => 'application/json');
$options = array('auth' => array('user', 'pass'));
$request = Requests::get('https://api.kawalcorona.com/indonesia/provinsi/', $headers, $options);


$a_provinsi_corona = $request->body;
$dns = 'DKI Jakarta';
// persiapkan curl

$b_provinsi_corona = json_decode($a_provinsi_corona); //lalu decode
foreach ($b_provinsi_corona as $bb_b_provinsi_corona) { //loop sampai menemukan yg pas
    if (strtolower($bb_b_provinsi_corona->attributes->Provinsi) == $dns) { //jika nama provinsi sama maka
        $reply = 'Provinsi : ' . $bb_b_provinsi_corona->attributes->Provinsi . PHP_EOL . PHP_EOL .
            '😊 Total sembuh : ' . $bb_b_provinsi_corona->attributes->Kasus_Semb . PHP_EOL .
            '😞 Total positif : ' . $bb_b_provinsi_corona->attributes->Kasus_Posi . PHP_EOL .
            '😢 Total meninggal : ' . $bb_b_provinsi_corona->attributes->Kasus_Meni . PHP_EOL;
        header('type: text/plain');
        echo $reply;
    }
}
