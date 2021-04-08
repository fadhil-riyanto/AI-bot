<?php
error_reporting(0);

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
    $apicheck = json_decode(file_get_contents(__DIR__ . '/../json_data/api.json'));
    foreach ($apicheck as $keys) {
        if ($keys->key == $me) {
            $apikey_check = true;
        }
    }
    if (@$apikey_check == true) {
    } else {
        render_json(array(
            'error' => 'HTTP 403, Apikey salah. butuh apikey? minta sama @fadhil_riyanto di telegram'
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
        "by" => "fadhil_riyanto",
        "telegram" => "@fadhil_riyanto",
        "pesan" => "Jangan flood request, hargai pembuatnya, dan tetap dirumah",
        "data" => $array
    );
    echo json_encode($rend, JSON_PRETTY_PRINT);
}

// require __DIR__ . '/../vendor/autoload.php';
// require __DIR__ . '/../pengaturan/env.php';
// $file = "ratelimiterr.json";
// $anggota = file_get_contents($file);
// $data = json_decode($anggota, true);

// if ($data[0]['request'] > 50) {
//     try {
//         $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
//         $db->where("id", 1);
//         $usermid = $db->getOne("api_stats");
//         $datadb = array(
//             "total_req" => $usermid['total_req'] + $data[0]['request']
//         );
//         $db->update('api_stats', $datadb);

//         foreach ($data as $key => $d) {
//             if ($d['data'] == 1) {
//                 $data[$key]['data'] = 1;
//                 $data[$key]['request'] = 0;
//             }
//         }
//         $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
//         $anggota = file_put_contents($file, $jsonfile);
//     } catch (\Throwable $th) {
//         //throw $th;
//     }
// }
// foreach ($data as $key => $d) {
//     if ($d['data'] == 1) {
//         $data[$key]['data'] = 1;
//         $data[$key]['request'] = $d['request'] + 1;
//     }
// }
// $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
// $anggota = file_put_contents($file, $jsonfile);

//echo get_client_ip();
// var_dump($_REQUEST);
