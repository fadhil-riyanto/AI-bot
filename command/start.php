<?php
$reply = 'Haii ' . $username . ', Apa kabar? ' . PHP_EOL . 'Saya bot buatan fadhil riyanto, jika kamu belom paham apa saja command di bot ini, kamu bisa tulis /help';
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
