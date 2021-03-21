<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

if (isset($_GET['key']) && isset($_GET['tipe'])) {
    $key = $_GET['key'];
    $tipe = $_GET['tipe'];

    $getkey = file_get_contents(__DIR__ . '/../json_data/key.json');
    $ketdec = json_decode($getkey);
    foreach ($ketdec as $keys) {
        if ($keys->key != $key) {
        }
    }
    if ($tipe == "brainly") {
        if (isset($_GET['query'])) {
            $st = new Brainly($_GET['query']);
            $results = $st->exec();
            header('Content-Type: application/json');
            echo json_encode($results, JSON_PRETTY_PRINT);
        }
    }
}
