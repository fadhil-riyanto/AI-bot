<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

$udahDiparse_hash = "jika trapesium abcd dan pqrs sebangun maka panjang bc adalah";
$st = new Brainly($udahDiparse_hash);
$results = $st->exec();

echo var_dump($results);
