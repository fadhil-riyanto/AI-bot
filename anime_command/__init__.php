<?php
$animecomm = explode(' ', $text);
function cek_apakah_anime_ada($cek)
{
    global $hasilcommand;
    $cek = substr($cek, 1);
    $gets = file_get_contents('https://waifu.pics/api/sfw/' . $cek);
    $dec = json_decode($gets);
    if ($dec == null) {
        return false;
    } elseif (isset($dec->message) && $dec->message == "Not Found") {
        return false;
    } else {
        $hasilcommand = $cek;
        return true;
    }
}
$checkanime = cek_apakah_anime_ada($animecomm[0]);
if ($checkanime == true) {
    $imganimedec = json_decode(file_get_contents('https://waifu.pics/api/sfw/' . $hasilcommand));
    $content = array('chat_id' => $chat_id, 'photo' => $imganimedec->url, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendPhoto($content);
}
