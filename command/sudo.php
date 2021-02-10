<?php
if ($userID != $userid_pemilik) {
    $reply = 'Acces denied for you!' . PHP_EOL . PHP_EOL . 'acces grant for @fadhil_riyanto';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

$getStringFromSpasi = explode(' ', $udahDiparse);
if ($getStringFromSpasi[0] == 'debug' || $getStringFromSpasi[0] == 'debugmode') {
    if ($getStringFromSpasi[1] == 'on') {
        $anggota = file_get_contents(__DIR__ . '/../pengaturan/settings.json');

        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['no'] === 1) {
                $data[$key]['debug'] = true;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents(__DIR__ . '/../pengaturan/settings.json', $jsonfile);
        $reply = 'Mode debug dinyalakan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } elseif ($getStringFromSpasi[1] == 'off') {
        $anggota = file_get_contents(__DIR__ . '/../pengaturan/settings.json');

        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['no'] === 1) {
                $data[$key]['debug'] = false;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents(__DIR__ . '/../pengaturan/settings.json', $jsonfile);
        $reply = 'Mode debug dimatikan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($getStringFromSpasi[0] == 'dataset') {
    if ($getStringFromSpasi[1] == 'count') {
        $bucin = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/bucin.json')));
        $faktaunik = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/faktaunik.json')));
        $katabijak = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/katabijak.json')));
        $pantun = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/pantun.json')));
        $quot = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/quot.json')));
        $reply = 'jumlah dataset di /json_data/fiturTambahan ' . PHP_EOL .
            'bucin : ' . $bucin . PHP_EOL .
            'faktaunik : ' . $faktaunik . PHP_EOL .
            'katabijak : ' . $katabijak . PHP_EOL .
            'pantun : ' . $pantun . PHP_EOL .
            'quot : ' . $quot;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
