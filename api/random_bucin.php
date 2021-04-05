<?php
$getQuotesJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/bucin.json');
$getQuotesJSONsaxDec = json_decode($getQuotesJSONsax);
$jumlah =  count($getQuotesJSONsaxDec);
header('Content-Type: application/json');
echo json_encode($getQuotesJSONsaxDec[random_int(0, $jumlah)], TRUE);
