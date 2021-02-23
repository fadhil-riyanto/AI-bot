<?php

use \Brush\Pastes\Draft;
use \Brush\Accounts\Developer;
use \Brush\Exceptions\BrushException;

$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "ups, anda harus memasukkan kode yang akan disimpan di pastebin";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $api_dev_key             = PASTEBIN_API; // your api_developer_key
    $api_paste_code         = $udahDiparse; // your paste text
    $api_paste_private         = '1'; // 0=public 1=unlisted 2=private
    $api_paste_name            = 'justmyfilename.php'; // name or title of your paste
    $api_paste_expire_date         = '10M';
    $api_paste_format         = 'php';
    $api_user_key             = ''; // if an invalid or expired api_user_key is used, an error will spawn. If no api_user_key is used, a guest paste will be created
    $api_paste_name            = urlencode($api_paste_name);
    $api_paste_code            = urlencode($api_paste_code);

    $url                 = 'https://pastebin.com/api/api_post.php';
    $ch                 = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'api_option=paste&api_user_key=' . $api_user_key . '&api_paste_private=' . $api_paste_private . '&api_paste_name=' . $api_paste_name . '&api_paste_expire_date=' . $api_paste_expire_date . '&api_paste_format=' . $api_paste_format . '&api_dev_key=' . $api_dev_key . '&api_paste_code=' . $api_paste_code . '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_VERBOSE, 1);
    // curl_setopt($ch, CURLOPT_NOBODY, 0);

    $response              = curl_exec($ch);
    $reply = "yey, paste berhasil dibuat. linknya " . $response;
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
