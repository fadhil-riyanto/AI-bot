<?php
$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

if ($azanHilangcommand == null || !isset($promote_uid)) {
    $reply = 'Hai ' . $username . PHP_EOL . 'maaf, untuk membanned user. anda bisa mention ke user yang ingin di banned atau mereply pesan nya';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    if ($promote_uid == null) {
        $h = username_resolver($udahDiparse);
        $promote_uid = $h['id'];
    }
    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid
    );

    $telegram->kickChatMember($param_promote);

    $reply = $unamepromote . ', dibanned!!.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);


    //debug
    // $reply = $unamepromote . ', dibanned!!.';
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
    //unban lagi
    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid
    );
    $telegram->unbanChatMember($param_promote);
}




// $unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';


// $azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
// $udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
// if (isset($promote_uid)) {
    
// } else {

//     $reply = 'ups, anda harus mereply user yang ingin dibanned.';
//     $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
//     $telegram->sendMessage($content);
// }
