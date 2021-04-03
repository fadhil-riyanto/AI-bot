<?php
$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

if (isset($promote_uid)) {
    $noreply = $promote_uid;
} elseif ($udahDiparse != null) {
    $h = username_resolver($udahDiparse);
    $noreply = $h['id'];
} elseif ($udahDiparse == null) {
    $noreply = null;
}

if ($noreply == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'maaf, untuk mengkick user. anda bisa mention ke user yang ingin di kick atau mereply pesan nya';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $noreply
    );

    $telegram->kickChatMember($param_promote);

    $reply = 'user telah dikick!!.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
