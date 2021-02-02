<?php

$reply = "tes";
$option = array(
    array(
        $telegram->buildInlineKeyBoardButton("tombol HAHAHA", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot panggil'),
        $telegram->buildInlineKeyBoardButton("dua", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot start')
    ),
);
$keyb = $telegram->buildInlineKeyBoard($option);
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
