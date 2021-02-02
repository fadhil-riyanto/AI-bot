<?php
$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'sekarang tanggal ' . date('l, d F Y');
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);