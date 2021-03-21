<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

if (isset($_GET['key']) && isset($_GET['query'])) {
    $key = $_GET['key'];
    $query = $_GET['query'];

    $getkey = file_get_contents(__DIR__ . '/../json_data/key.json');
    $ketdec = json_decode($getkey);
    foreach ($ketdec as $keys) {
        if ($keys->key != $key) {
        }
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://server-data.000webhostapp.com/brainly.php?query=" . $query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    header('Content-Type: application/json');
    echo $output;
}
