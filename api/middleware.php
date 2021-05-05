<?php
error_reporting(0);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';

// function get_client_ip()
// {
//     $ipaddress = '';
//     if (isset($_SERVER['HTTP_CLIENT_IP']))
//         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//     else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//     else if (isset($_SERVER['HTTP_X_FORWARDED']))
//         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//     else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
//         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//     else if (isset($_SERVER['HTTP_FORWARDED']))
//         $ipaddress = $_SERVER['HTTP_FORWARDED'];
//     else if (isset($_SERVER['REMOTE_ADDR']))
//         $ipaddress = $_SERVER['REMOTE_ADDR'];
//     else
//         $ipaddress = 'UNKNOWN';
//     return $ipaddress;
// }
// $getip = get_client_ip();
if (isset($_GET['apikey'])) {
    $me = $_GET['apikey'];
    require __DIR__ . '/../include/api_oauthsystem.php';
    $getjsondbmysql = auth_api_getdata();
    if ($getjsondbmysql == 'error_conn') {
    } elseif ($getjsondbmysql == 'error_db') {
    } else {
        $apicheck = json_decode($getjsondbmysql);
        foreach ($apicheck as $keys) {
            if ($keys->key == $me) {
                $apikey_check = true;
            }
        }
    }


    if (@$apikey_check == true) {
    } else {
        render_json(array(
            'error' => 'HTTP 403, apikey yang anda masukkan salah',
            'msg' => 'butuh apikey? minta sama @fadhil_riyanto di telegram'
        ));
        exit();
    }
} else {
    render_json(array(
        'error' => 'HTTP 404, Apikey tidak ditemukan. butuh apikey? minta sama @fadhil_riyanto di telegram'
    ));
    exit();
}

function render_json($array)
{
    header('Content-Type: application/json', true, 200);
    $rend = array(
        "telegram" => "@fadhil_riyanto",
        "pesan" => "Jangan flood request, bikin banjir disini. tetap jaga kesehatan dan tetap dirumah",
        "data" => $array
    );
    echo json_encode($rend, JSON_PRETTY_PRINT);
}
