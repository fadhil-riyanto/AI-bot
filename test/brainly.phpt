<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

$query = "jika sel tubuh pada buah tomat mempunyai 24 kromosom maka jumlah kromosom pada serbuk sarinya adalah";
$st = new Brainly($query);
$result = $st->exec();

if (count($result) === 0) {
    print "Not found!\n";
} else {
    print json_encode($result, JSON_PRETTY_PRINT);
}
