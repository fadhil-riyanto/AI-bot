<?php
$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';


$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if (isset($promote_uid)) {
    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid
    );
    $returntg = $telegram->kickChatMember($param_promote);
    if ($returntg['ok'] == false) {
        $reply = "🚫 maaf, saya tidak cukup hak untuk mengeluarkan  dan membatasi anggota obrolan";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
    //debug

    //silent mode, tanpa mereply di korban
    // $reply = json_encode($returntg, JSON_PRETTY_PRINT);
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
    //unban lagi

} else {

    $reply = 'ups, anda harus mereply user yang ingin silent kick.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
