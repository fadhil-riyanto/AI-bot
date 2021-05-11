<?php
$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';


$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if (isset($promote_uid)) {
    $admins = dapatkan_admin($chat_id);
    foreach ($admins['result'] as $adminnn) {
        if ($adminnn['user']['id'] == ID_BOT) {
            $previelge = array(
                "is_anonymous" => var_to_str($adminnn['is_anonymous']),
                "can_change_info" => var_to_str($adminnn['can_change_info']),
                "can_post_messages" => var_to_str($adminnn['can_post_messages']),
                "can_edit_messages" => var_to_str($adminnn['can_edit_messages']),
                "can_delete_messages" => var_to_str($adminnn['can_delete_messages']),
                "can_invite_users" => var_to_str($adminnn['can_invite_users']),
                "can_restrict_members" => var_to_str($adminnn['can_restrict_members']),
                "can_pin_messages" => var_to_str($adminnn['can_pin_messages']),
                "can_promote_members" => var_to_str($adminnn['can_promote_members']),
            );
        }
    }

    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid,
        'is_anonymous' => $previelge['is_anonymous'],
        'can_change_info' => $previelge['can_change_info'],
        'can_post_messages' => $previelge['can_post_messages'],
        'can_edit_messages' => $previelge['can_edit_messages'],
        'can_delete_messages' => $previelge['can_delete_messages'],
        'can_invite_users' => $previelge['can_invite_users'],
        'can_restrict_members' => $previelge['can_restrict_members'],
        'can_pin_messages' => $previelge['can_pin_messages'],
        'can_promote_members' => $previelge['can_promote_members'],
    );
    $param_jadi = http_build_query($param_promote);
    $req_params = 'https://api.telegram.org/bot' . TG_HTTP_API . '/promoteChatMember?' . $param_jadi;
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $req_params);

    // $reply = "debug : " . $response;
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
    // die();
    // $datass = json_decode($response);
    $datass = $response;
    if ($datass->description == 'Bad Request: not enough rights') {
        $reply = 'ups, saya harus diberi hak untuk menambah dan menghapus admin';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;
    }

    //debug
    $reply = $unamepromote . ', Diangkat menjadi admin grup ini.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $reply = 'ups, anda harus mereply user yang ingin dianggat menjadi admin.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
