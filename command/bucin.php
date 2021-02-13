<?php
$getPantunJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/bucin.json');
$getPantunJSONsaxDec = json_decode($getPantunJSONsax);
$jumlahbucin = count($getPantunJSONsaxDec);
$reply = $getPantunJSONsaxDec[random_int(0, $jumlahbucin)]->bucin;
// echo $reply;
$option = array(
    array($telegram->buildInlineKeyBoardButton("refres", $url = "", $callback_data = '/bucin_i@fadhil_riyanto_bot'))
);
$keyb = $telegram->buildInlineKeyBoard($option);
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$urlCall = $telegram->sendMessage($content);
$msgidUntukedit = $urlCall['result']['message_id'];
function getUseridFromeditmessage($userID)
{
    $file = __DIR__ . "/../json_data/fitur_tambahan_json/bucin.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID) {
            return true;
        }
    }
}
$cheker = getUseridFromeditmessage($userID);
if ($cheker == true) {
    $file = __DIR__ . "/../json_data/fitur_tambahan_json/bucin.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $key => $d) {
        if ($d['userid'] === $userID) {
            $data[$key]['msgid'] = $msgidUntukedit;
        }
    }
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
} elseif ($cheker == null) {
    $file = __DIR__ . "/../json_data/fitur_tambahan_json/bucin.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);

    $data[] = array(
        "userid" => $userID,
        "msgid" => $msgidUntukedit
    );

    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
}
