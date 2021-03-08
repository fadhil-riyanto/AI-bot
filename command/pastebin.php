<?php

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $addhashsha1 = hash('sha1', $randomString . random_int(1, 10000000000000));
    $addsha256 = hash('sha256', $addhashsha1 . random_int(1, 1000000000000000) . random_int(4, 40000000000));
    return hash('sha1', $addsha256);
}


$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "ups, anda harus memasukkan teks yang ingin dijadikan paste.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $paste_id = generateRandomString($length = 10);
    $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $data = array(
        "userid" => $userID,
        "paste_id" =>  $paste_id,
        "data" => $udahDiparse
    );
    $id = $db->insert('pastebin', $data);
    if ($id) {
        $reply = "yay, link pastebin telegram kamu https://t.me/" . USERNAME_BOT_NON_AT . '?start=paste_' . $paste_id;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = "ups ada kesalahan internal saat menginsert data. Reason : " . $db->getLastError();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
