<?php

$deteksiid = $sms_db_cache->findOneBy(["userid", "=", $userID]);
$reply = $text;
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$editmsg = $telegram->sendMessage($content);
