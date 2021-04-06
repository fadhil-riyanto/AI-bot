<?php
require __DIR__ . '/middleware.php';
$getQuotesJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/katabijak.json');
$getQuotesJSONsaxDec = json_decode($getQuotesJSONsax);
$jumlah =  count($getQuotesJSONsaxDec);

render_json($getQuotesJSONsaxDec[random_int(0, $jumlah)]);
