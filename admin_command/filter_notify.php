<?php

if ($adanParseadmin[1] == 'on') {
    // $data = array(
    //     'filter_notify' => 'true',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'filter_notify' => 'true',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'notifikasi filter dinyalakan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($adanParseadmin[1] == 'off') {
    // $data = array(
    //     'filter_notify' => 'false',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'filter_notify' => 'false',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'notifikasi filter dimatikan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update failed: ' . $db->getLastError();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} else {
    $reply = 'Ups, anda harus memasukkan paramater on / off untuk pengaturan notifikasi filters message.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
