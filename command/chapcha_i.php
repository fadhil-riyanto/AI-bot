<?php
//$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);

$parsedata = explode(' ', $text_plain_nokarakter);
function getUseridFromeditmessage($userID)
{
    global $chat_id;
    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID && $d['chatid'] == $chat_id) {
            return true;
        }
    }
}
$verifikasichapcha = getUseridFromeditmessage($parsedata[1]);
if ($verifikasichapcha == true) {
    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID && $d['chatid'] == $chat_id) {
            if ($d['percobaan'] > 2) {
                $reply = 'ini akan di kick';
                $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                $telegram->sendMessage($content);
            } else {
                if ($parsedata[2] == $d['pharse']) {
                    $reply = 'ini unmute';
                    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                    $telegram->sendMessage($content);

                    //hapus record json
                } else {
                    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
                    $anggota = file_get_contents($file);
                    $data = json_decode($anggota, true);
                    foreach ($data as $key => $d) {
                        if ($d['userid'] === $userID) {
                            $data[$key]['percobaan'] = $d['percobaan'] + 1;
                        }
                    }
                    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                    $anggota = file_put_contents($file, $jsonfile);
                }
            }
        } else {
            $jawabquery = $telegram->getData();
            $alswecl = array('callback_query_id' => $jawabquery['callback_query']['id'], 'text' => 'ups, chapcha ini bukan untuk anda', 'show_alert' => true);
            $telegram->answerCallbackQuery($alswecl);
        }
    }
}
