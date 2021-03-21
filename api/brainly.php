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

    $st = new Brainly($query);
    $results = $st->exec();
    echo json_encode($results, true);
}
