<?php
//$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($adanParseadmin[1] == 'on') {
    // $data = array(
    //     'set_leaveuser_mode' => 'true',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'set_leaveuser_mode' => 'true',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'pesan selamat tinggal dinyalakan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
    exit;
} elseif ($adanParseadmin[1] == 'off') {
    // $data = array(
    //     'set_leaveuser_mode' => 'false',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'set_leaveuser_mode' => 'false',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'pesan selamat tinggal dimatikan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
    exit;
} else {
    $reply = 'Ups, anda harus memasukkan paramater on / off untuk pengaturan pesan tinggal grup.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
