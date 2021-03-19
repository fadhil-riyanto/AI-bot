<?php
$sendmsgawal = microtime(true);
$reply = 'Pong!';
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$awal_ping = $telegram->sendMessage($content);
$sendmsgakhir = microtime(true);
$hasilsendmsg = $sendmsgakhir - $sendmsgawal;

//query db
$db_time_start = microtime(true);
$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 'hai' ");
$db_time_end = microtime(true);
$db_exec = $db_time_end - $db_time_start;

$hasilbagus = 'Pong!' . PHP_EOL . PHP_EOL .
    'Mysql query: ' . $db_exec;
$content = array('chat_id' => $chat_id, 'message_id' => $awal_ping['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->editMessageText($content);


//scrappe
$scrappe_start = microtime(true);
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://google.com');
$scrappe_end = microtime(true);
$scrappehasil = $scrappe_end - $scrappe_start;

$hasilbagus = 'Pong!' . PHP_EOL . PHP_EOL .
    'Mysql query: ' . $db_exec . PHP_EOL .
    'Scrappe: ' . $scrappehasil;
$content = array('chat_id' => $chat_id, 'message_id' => $awal_ping['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->editMessageText($content);

$APISget_start = microtime(true);
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
$APISget_end = microtime(true);
$APISgethasil = $APISget_end - $APISget_start;

$hasilbagus = 'Pong!' . PHP_EOL . PHP_EOL .
    'Mysql query: ' . $db_exec . PHP_EOL .
    'Scrappe: ' . $scrappehasil . PHP_EOL .
    'API (get): ' . $APISgethasil;
$content = array('chat_id' => $chat_id, 'message_id' => $awal_ping['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->editMessageText($content);

$APISpost_start = microtime(true);
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
$APISpost_end = microtime(true);
$APISposthasil = $APISpost_end - $APISpost_start;

$hasilbagus = 'Pong!' . PHP_EOL . PHP_EOL .
    'Mysql query: ' . $db_exec . PHP_EOL .
    'Scrappe: ' . $scrappehasil . PHP_EOL .
    'API (get): ' . $APISgethasil . PHP_EOL .
    'API (post): ' . $APISposthasil . PHP_EOL .
    'send msg: ' . $hasilsendmsg . PHP_EOL;
$content = array('chat_id' => $chat_id, 'message_id' => $awal_ping['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->editMessageText($content);

// $hasilbagus = 'Pong!' . PHP_EOL . PHP_EOL .
//     'Mysql query: ' . $db_exec . PHP_EOL .
//     'Scrappe: ' . $scrappehasil . PHP_EOL .
//     'API (get): ' . $APISgethasil . PHP_EOL .
//     'API (post): ' . $APISposthasil . PHP_EOL .
//     'send msg: ' . $hasilsendmsg . PHP_EOL . PHP_EOL .
//     'total: ' . $db_exec + $scrappehasil + $APISgethasil + $APISposthasil + $hasilsendmsg;
// $content = array('chat_id' => $chat_id, 'message_id' => $awal_ping['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// $telegram->editMessageText($content);

$totalping = $db_exec + $scrappehasil + $APISgethasil + $APISposthasil + $hasilsendmsg;
$hasilbagus = 'Pong!' . PHP_EOL . PHP_EOL .
    'Mysql query: ' . $db_exec . PHP_EOL .
    'Scrappe: ' . $scrappehasil . PHP_EOL .
    'API (get): ' . $APISgethasil . PHP_EOL .
    'API (post): ' . $APISposthasil . PHP_EOL .
    'send msg: ' . $hasilsendmsg . PHP_EOL . PHP_EOL .
    'total: ' . $totalping;
$content = array('chat_id' => $chat_id, 'message_id' => $awal_ping['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->editMessageText($content);
