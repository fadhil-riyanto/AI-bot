<?php
berita:
$xmlparseTempo = simplexml_load_file('https://rss.tempo.co/nasional');
$jsonTempo = json_encode($xmlparseTempo, JSON_PRETTY_PRINT);
$beritaTempo = json_decode($jsonTempo);
$angka_tempo = count($beritaTempo->channel->item);
$randomintForberita_tempo = random_int(0, $angka_tempo);
$reply_tempo = 'Judul : ' . $beritaTempo->channel->item[$randomintForberita_tempo]->title . PHP_EOL . PHP_EOL .
    'Link : ' . $beritaTempo->channel->item[$randomintForberita_tempo]->link . PHP_EOL . PHP_EOL;

$xmlparse_kumparan = simplexml_load_file('https://lapi.kumparan.com/v2.0/rss/');
$json_kumparan = json_encode($xmlparse_kumparan, JSON_PRETTY_PRINT);
$berita_kumparan = json_decode($json_kumparan);
$angka_kumparan = count($berita_kumparan->channel->item);
$randomintForberita_kumparan = random_int(0, $angka_kumparan);
$reply_kumparan = 'Judul : ' . $berita_kumparan->channel->item[$randomintForberita_kumparan]->title . PHP_EOL . PHP_EOL .
    'Link : ' . $berita_kumparan->channel->item[$randomintForberita_kumparan]->link . PHP_EOL . PHP_EOL;
if ($beritaTempo->channel->item[$randomintForberita_tempo]->title == null) {
    goto berita;
} elseif ($berita_kumparan->channel->item[$randomintForberita_kumparan]->title == null) {
    goto berita;
}
$randomintberita = random_int(0, 1);
if ($randomintberita == 1) {
    $reply = $reply_kumparan;
} elseif ($randomintberita == 0) {
    $reply = $reply_tempo;
}
$file = __DIR__ . "/../json_data/fitur_tambahan_json/berita.json";
$anggota = file_get_contents($file);
$data = json_decode($anggota, true);
foreach ($data as $d) {
    if ($d['userid'] == $userID) {
        $idPesan = $d['msgid'];
    }
}
$option = array(
    array($telegram->buildInlineKeyBoardButton("refres", $url = "", $callback_data = '/berita_i@fadhil_riyanto_bot'))
);
$keyb = $telegram->buildInlineKeyBoard($option);

$content = array('chat_id' => $chat_id, 'text' => $reply, 'message_id' => $idPesan, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
$msgUdahDikirim = $telegram->editMessageText($content);
