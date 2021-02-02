<?php
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

$file = __DIR__ . "/../json_data/editMsgID.json";
$anggota = file_get_contents($file);
$data = json_decode($anggota, true);
foreach ($data as $d) {
    if ($d['userid'] == $userID) {
        $idPesan = $d['msgid'];
    }
}

$get_help_files = file_get_contents(__DIR__ . '/../json_data/slangword.json');
$helper = json_decode($get_help_files, true);


$reply = $helper[$adanParse[1]];
$option = array(
    array($telegram->buildInlineKeyBoardButton("kembali", $url = "", $callback_data = '/help_i@fadhil_riyanto_bot'))
);
$keyb = $telegram->buildInlineKeyBoard($option);
$content = array('chat_id' => $chat_id, 'text' => $reply, 'message_id' => $idPesan, 'reply_markup' => $keyb, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$delParameter = $telegram->editMessageText($content);

$msgidUntukedit = $delParameter['result']['message_id'];

function getUseridFromeditmessagedel($userID)
{
    $file = __DIR__ . "/../json_data/editMsgIDdelete.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID) {
            return true;
        }
    }
}
$cheker_del = getUseridFromeditmessagedel($userID);
if ($cheker_del == true) {
    $file = __DIR__ . "/../json_data/editMsgIDdelete.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $key => $d) {
        if ($d['userid'] === $userID) {
            $data[$key]['msgid'] = $msgidUntukedit;
        }
    }
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
} elseif ($cheker_del == null) {
    $file = __DIR__ . "/../json_data/editMsgIDdelete.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);

    $data[] = array(
        "userid" => $userID,
        "msgid" => $msgidUntukedit
    );

    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
}
