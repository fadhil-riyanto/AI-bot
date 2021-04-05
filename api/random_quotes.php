<?php
require __DIR__ . '/middleware.php';
$getQuotesJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/quot.json');
$getQuotesJSONsaxDec = json_decode($getQuotesJSONsax);
$jumlah =  count($getQuotesJSONsaxDec);

echo json_encode($getQuotesJSONsaxDec[random_int(0, $jumlah)], TRUE);
