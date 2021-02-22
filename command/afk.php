<?php
$result = $telegram->getData();
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "ups, anda harus memasukkan alasan anda afk";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $msgidUntukedit = $udahDiparse;
    $namedafkjson = __DIR__ . '/../json_data/afk.json';
    function getUseridFromeditmessage($userID)
    {
        $file = __DIR__ . "/../json_data/afk.json";
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
        $file = __DIR__ . "/../json_data/afk.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['userid'] === $userID) {
                $data[$key]['alasan'] = $msgidUntukedit;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    } elseif ($cheker == null) {
        $file = __DIR__ . "/../json_data/afk.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);

        $data[] = array(
            "userid" => $userID,
            "alasan" => $msgidUntukedit
        );

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    }
}
