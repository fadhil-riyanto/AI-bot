<?php
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where('userid', $userID);
if ($db->delete('afk_user_data')) {
    $reply = "anda sudah tidak afk!";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $reply = "ups, anda kan tidak afk...";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
