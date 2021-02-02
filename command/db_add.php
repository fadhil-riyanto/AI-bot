<?php
if ($userID != $userid_pemilik) {
    exit;
}
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

$db_kirim = explode('$', $udahDiparse);
mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$db_kirim[0]', '$db_kirim[1]')");


$reply = 'done';

$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
