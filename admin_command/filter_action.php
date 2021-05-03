<?php
if ($adanParseadmin[1] == 'mute') {
    // $data = array(
    //     'filters_hukuman' => 'mute',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'filters_hukuman' => 'mute',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'filter hukuman diatur ke \'mute\'';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($adanParseadmin[1] == 'delete') {
    // $data = array(
    //     'filters_hukuman' => 'delete',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'filters_hukuman' => 'delete',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'filter hukuman diatur ke \'hapus pesan\'';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($adanParseadmin[1] == 'ban') {
    // $data = array(
    //     'filters_hukuman' => 'ban',
    // );
    // $db->where('gid', $chat_id);
    $update_verify = $db->update('grup_data', [
        'filters_hukuman' => 'ban',
    ], [
        'gid' => $chat_id
    ]);
    if ($update_verify) {
        $reply = 'filter hukuman diatur ke \'banned\'';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'update error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} else {
    $reply = 'Ups, anda harus memasukkan paramater mute / delete / ban untuk pengaturan hukuman filters pesan.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
