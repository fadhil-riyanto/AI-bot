<?php

$reply = '1';
//$reply = strlen(implode(PHP_EOL . PHP_EOL, $tmplate_history));
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
$telegram->sendMessage($content);

// $reply = Emoji::Encode($text_plain_nokarakter);
// //$reply = strlen(implode(PHP_EOL . PHP_EOL, $tmplate_history));
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
