<?php

require __DIR__ . '/../vendor/autoload.php';

use Zxing\QrReader;

$qrcode = new QrReader(__DIR__ . '/../tmp/qrtemp.png');
$text = $qrcode->text();
var_dump($text);
