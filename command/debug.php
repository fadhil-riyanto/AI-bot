<?php
$content = array('chat_id' => $chat_id);
$adminlist = $telegram->getChatAdministrators($content);
foreach ($adminlist['result'] as $daftar) {
    $data[] = $daftar['user']['id'];
}
//g jadi lah
$reply = echo $data[0];
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
$urlCall = $telegram->sendMessage($content);
