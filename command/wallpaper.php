<?php
$url = "https://source.unsplash.com/random";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$a = curl_exec($ch); // $a will contain all headers

$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL

$content = array('chat_id' => $chat_id, 'caption' => 'enjoy dengan wallpaper barunya' , 'photo' => $url, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
$telegram->sendPhoto($content);
