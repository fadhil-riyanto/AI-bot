<?php
$getQuotesJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/quot.json');
$getQuotesJSONsaxDec = json_decode($getQuotesJSONsax);
$jawabanSebelumQuotes = array(
    'Silahkan dipahami....',
    'ngab, gw punya quotes keren nie',
    'nih dengerin...',
    'the quotes....wkwk',
    'noh quotes dari org orang',
    'ini quotes nya bang'
);
$reply = $jawabanSebelumQuotes[random_int(0, 5)] . PHP_EOL  . PHP_EOL .
    'By : ' . $getQuotesJSONsaxDec[random_int(1, 17330)]->by . PHP_EOL .
    'Quotes : ' . $getQuotesJSONsaxDec[random_int(1, 17330)]->quotes . PHP_EOL;
echo $reply;
