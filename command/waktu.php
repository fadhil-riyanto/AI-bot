<?php
$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Sekarang jam ' . date('h:i:s a') . ', dihape kamu apa tidak cocok jamnya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);