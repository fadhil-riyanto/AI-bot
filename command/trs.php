<?php
$resultGetReply = $telegram->getData();
$textByreply = $resultGetReply['message']['reply_to_message']['text'];

$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);

if (!isset($textByreply)) {
    $reply = 'Ups, anda harus mereply pesan yang ingin di translate' . PHP_EOL . PHP_EOL .
        'gunakan ' . PHP_EOL . PHP_EOL .
        '<pre>/tr {kode bahasa}</pre>' . PHP_EOL . PHP_EOL . 'Kode bahasa : https://cloud.google.com/translate/docs/languages';
    $content = array('chat_id' => $chat_id, 'text' => $reply,   'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif (isset($adanParse[1]) and $textByreply) {
    $translateByReply = file_get_contents('https://api-translate.azharimm.tk/translate?engine=google&text=' . urlencode($textByreply) . '&to=' .  $adanParse[1]);
    $transhasil = json_decode($translateByReply);
    $reply = $transhasil->data->result;
    $content = array('chat_id' => $chat_id, 'text' => $reply,   'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif (isset($textByreply)) {
    $reply = 'ups masukkan kode bahasa';
    $content = array('chat_id' => $chat_id, 'text' => $reply,   'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} 

// $reply = $text;
// $content = array('chat_id' => $chat_id, 'text' => $reply,   'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);