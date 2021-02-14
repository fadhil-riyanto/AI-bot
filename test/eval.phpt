<?php
$string = readline('skrip : ');
$evals = addslashes($string);
$hasil = eval($string);

// $xmlparseTempo = simplexml_load_file('https://rss.tempo.co/nasional');$jsonTempo = json_encode($xmlparseTempo, JSON_PRETTY_PRINT);$beritaTempo = json_decode($jsonTempo);$angka_tempo = count($beritaTempo->channel->item);$randomintForberita_tempo = random_int(0, $angka_tempo);$reply_tempo = 'Judul : ' . $beritaTempo->channel->item[$randomintForberita_tempo]->title . PHP_EOL . PHP_EOL .'Link : ' . $beritaTempo->channel->item[$randomintForberita_tempo]->link . PHP_EOL . PHP_EOL;