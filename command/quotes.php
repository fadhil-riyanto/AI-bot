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
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
