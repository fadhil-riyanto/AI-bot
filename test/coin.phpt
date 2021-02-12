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
echo $angka_tempo;
