<?php
$ayat = file_get_contents('https://api.banghasan.com/quran/format/json/surat/67/ayat/9');
$jsonayat = json_decode($ayat);
foreach ($jsonayat->ayat->data->id as $ayat_for) {
    echo $ayat_for->teks . PHP_EOL;
}
