<?php
require __DIR__ . '/middleware.php';
$getQuotesJSONsax = file_get_contents(__DIR__ . '/../json_data/rs_rujukan.json');
$getQuotesJSONsaxDec = json_decode($getQuotesJSONsax);

render_json($getQuotesJSONsaxDec);
