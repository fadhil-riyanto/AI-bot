<?php
$a = json_decode(file_get_contents('https://api.banghasan.com/quran/format/json/surat/67/ayat/1-5'));
foreach ($a->ayat->data->ar as $arab) {
    echo $arab->teks;
}
