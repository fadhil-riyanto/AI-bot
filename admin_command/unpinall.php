<?php
$param_unpin = array(
    'chat_id' => $chat_id
);
$param_jadi = http_build_query($param_unpin);
$req_params = 'https://api.telegram.org/bot' . TG_HTTP_API . '/unpinAllChatMessages?' . $param_jadi;
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', $req_params);

$reply = 'semua pesan yang di pin telah dihapus.';
$content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
