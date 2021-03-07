<?php
$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';



$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if (isset($promote_uid) && isset($udahDiparse)) {
    if (strlen($udahDiparse) > 16) {
        $reply = 'ups, jumlah judul maksimal yang diperbolehkan telegram hanya 16 karakter (emoji tidak diperbolehkan).';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $content = array('chat_id' => $chat_id, 'user_id' => $promote_uid, 'custom_title' => $udahDiparse);
        $telegram->setChatAdministratorCustomTitle($content);
    }
    // $param_promote = array(
    //     'chat_id' => $chat_id,
    //     'user_id' => $promote_uid,
    //     'permissions' => '{"can_send_messages": false}',
    //     'until_date' => time() + 60
    // );
    // $param_jadi = http_build_query($param_promote);
    // $req_params = 'https://api.telegram.org/bot' . TG_HTTP_API . '/restrictChatMember?' . $param_jadi;
    // $client = new \GuzzleHttp\Client();
    // $response = $client->request('GET', $req_params);

    // //debug
    // $reply = $unamepromote . ', dimute.';

} elseif (isset($promote_uid) && isset($udahDiparse) == false) {
    $reply = 'ups, anda harus memasukan title baru untuk admin yang di reply.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $reply = 'ups, anda harus mereply admin yang ingin dirubah title nya.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
