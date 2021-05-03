<?php
if ($adanParseadmin[1] == 'on') {
    // $data = array(
    //     'captcha' => 'true',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'captcha' => 'true',
    ], [
        'gid' => $chat_id
    ]);

    if ($update_verify) {
        $reply = 'captcha mode dinyalakan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($adanParseadmin[1] == 'off') {
    // $data = array(
    //     'captcha' => 'false',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'captcha' => 'false',
    ], [
        'gid' => $chat_id
    ]);

    if ($update_verify) {
        $reply = 'captcha mode dimatikan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} else {
    $reply = 'Ups, anda harus memasukkan paramater on / off untuk pengaturan pesan selamat datang dengan captcha.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
