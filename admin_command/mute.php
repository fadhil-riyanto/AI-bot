<?php
$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';



$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if (isset($promote_uid) && isset($udahDiparse)) {
    // $content = array(
    //     'chat_id' => '-1001410961692',
    //     'user_id' => 1223173857,
    //     'can_change_info' => True,
    //     'can_post_messages' => True,
    //     'can_edit_messages' => True,
    //     'can_delete_messages' => True,
    //     'can_invite_users' => True,
    //     'can_restrict_members' => True,
    //     'can_pin_messages' => True,
    //     'can_promote_members' => True
    // );
    // $dbeug = $telegram->promoteChatMember($content);

    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid,
        'permissions' => '{"can_send_messages": false}',
        'until_date' => time() + 60
    );
    $param_jadi = http_build_query($param_promote);
    $req_params = 'https://api.telegram.org/bot' . TG_HTTP_API . '/restrictChatMember?' . $param_jadi;
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $req_params);

    //debug
    $reply = $unamepromote . ', dimute.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $reply = 'ups, anda harus mereply user yang ingin dimute.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
