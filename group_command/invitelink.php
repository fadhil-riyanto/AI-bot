<?php

$content = array('chat_id' => $chat_id);

$invitelink_data = $telegram->getChat($content);
$reply = 'Link untuk mengajak orang lain masuk ke grup ini adalah' . PHP_EOL . $invitelink_data['result']['invite_link'];
$content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => false);
$telegram->sendMessage($content);
