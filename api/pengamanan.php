<?php
if (isset($_GET['key'])) {
    $key = $_GET['key'];

    $getkey = file_get_contents(__DIR__ . '/../json_data/apikey.json');
    $ketdec = json_decode($getkey);
    foreach ($ketdec as $keys) {
        if ($keys->keyid != $key) {
            echo 'salah';
        }
    }
} else {
    $array = array(
        "alasan" => "key not ditemukan"
    );

    echo json_encode($array);
    exit;
}
