<?php
function send($data)
{
    global $chat_id;
    global $message_id;
    global $telegram;
    $content = array('chat_id' => $chat_id, 'text' => '<pre>' . htmlspecialchars(substr($data, 0, 4090)) . '</pre>', 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
function get_curl($data)
{
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $data);
    return $response->getBody();
}
function photo($link)
{
    global $chat_id;
    global $telegram;
    $konten = array('chat_id' => $chat_id, 'photo' => $link, 'caption' => '200 ');
    $telegram->sendPhoto($konten);
}
