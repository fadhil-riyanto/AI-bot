<?php
$getPantunJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/bucin.json');
$getPantunJSONsaxDec = json_decode($getPantunJSONsax);
$reply = $getPantunJSONsaxDec[random_int(0, 31058)]->bucin;
// echo $reply;

$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$urlCall = $telegram->sendMessage($content);
