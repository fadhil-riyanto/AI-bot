<?php
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($adanParseadmin[1] == 'on') {
    $data = array(
        'set_welcome_mode' => 'true',
    );
    $db->where('gid', $chat_id);
    if ($db->update('grup_data', $data)) {
        $reply = 'pesan selamat datang dinyalakan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update failed: ' . $db->getLastError();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
    exit;
} elseif ($adanParseadmin[1] == 'off') {
    $data = array(
        'set_welcome_mode' => 'false',
    );
    $db->where('gid', $chat_id);
    if ($db->update('grup_data', $data)) {
        $reply = 'pesan selamat datang dimatikan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update failed: ' . $db->getLastError();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
    exit;
} else {
    $reply = 'Ups, anda harus memasukkan paramater on / off untuk pengaturan pesan selamat datang.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
