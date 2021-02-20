<?php
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://waifu.pics/api/sfw/waifu');

// echo $response->getStatusCode(); // 200
// echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
// echo $response->getBody();
if ($response->getStatusCode() == 200) {
    $imganimedec = json_decode($response->getBody());
    $content = array('chat_id' => $chat_id, 'photo' => $imganimedec->url, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendPhoto($content);
} else {
    $reply = 'ups, ada kesalahan. coba lagi...' . PHP_EOL . PHP_EOL .
        'kalau masalah masih berlanjut, coba tanyakan ke grup ' . SUPPORT_GROUP . ' atau ke pemilik ' . PUMBUAT_BOT;
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'disable_web_page_preview' => true, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
exit;
