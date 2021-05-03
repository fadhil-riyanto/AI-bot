<?php

if ($adanParseadmin[1] == 'on') {
    // $data = array(
    //     'act_filters_detect' => 'true',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'act_filters_detect' => 'true',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'filter mode dinyalakan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($adanParseadmin[1] == 'off') {
    // $data = array(
    //     'act_filters_detect' => 'false',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'act_filters_detect' => 'false',
    ], [
        'gid' => $chat_id
    ]);

    if ($update_verify) {
        $reply = 'filter mode dimatikan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} else {
    $reply = 'Ups, anda harus memasukkan paramater on / off untuk pengaturan filters message.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
