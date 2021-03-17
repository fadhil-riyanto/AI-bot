<?php
$time_databasehitung_mulai = microtime(true);
/*
$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 'hai' ");
*/
$time_databasehitung_end = microtime(true);
$execution_time_database = ($time_databasehitung_mulai - $time_databasehitung_end) / 60;

$time_getUrlhitung_mulai = microtime(true);
//$q = file_get_contents('https://google.com');
$time_getUrlhitung_end = microtime(true);
$execution_time_getUrl = ($time_getUrlhitung_mulai - $time_getUrlhitung_end) / 60;

$waktuPing =  $execution_time_database + $execution_time_getUrl;

$reply = 'Pong!';
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
