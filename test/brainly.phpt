<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

$udahDiparse_hash = "apa itu internet";
$st = new Brainly($udahDiparse_hash);
$results = $st->exec();

echo var_dump($results);
