<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . '/../pengaturan/env.php';
$telegramAPIs   = TG_HTTP_API;
$telegram = new Telegram($telegramAPIs);
function send($data, $chat_id)
{
    global $telegram;
    $content = array('chat_id' => $chat_id, 'text' => '<pre>' . htmlspecialchars(substr($data, 0, 4090)) . '</pre>', 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
function tg_animate($data, $jumlah, $chat_id)
{
    global $telegram;
    $content = array('chat_id' => $chat_id, 'text' => $data, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $a = $telegram->sendMessage($content);
}
function curl_get($data)
{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $data);
    return $response->getBody();
}
function curl_post($data)
{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', $data);
    return $response->getBody();
}
function photo($link)
{
    global $chat_id;
    global $telegram;
    $konten = array('chat_id' => $chat_id, 'photo' => $link, 'caption' => '200 ');
    $telegram->sendPhoto($konten);
}
$tg_data = $telegram->getData();
