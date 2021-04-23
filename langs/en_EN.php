<?php
$lang_translate = array(
    //command /start
    'modul_start' => 'Hi! ' . $username . ', How are you? ' . PHP_EOL . 'I am a bot made by Fadhil Riyanto, if you don\'t understand what the commands in this bot are, you can write /help',

    //command /adminlist
    'modul_adminlist_admin_tidak_ditemukan' => 'whoops, we can\'t find the admin',

    //command /azan
    'modul_azan_pattern_kosong' => 'Sorry, use the <pre>/azan city name </pre> pattern' . PHP_EOL . PHP_EOL . 'for example: /azan city jakarta',
    'modul_azan_sukses' => 'Haiiiiiiiiiiiii ' . $username . ', Jadwal azan dikota ' . strtolower($udahDiparse) . ' Adalah' . PHP_EOL . PHP_EOL .
        'subuh : ' . $jsonHasilazancurl->jadwal->data->subuh . PHP_EOL .
        'imsak : ' . $jsonHasilazancurl->jadwal->data->imsak . PHP_EOL .
        'terbit : ' . $jsonHasilazancurl->jadwal->data->terbit . PHP_EOL .
        'dhuha : ' . $jsonHasilazancurl->jadwal->data->dhuha . PHP_EOL .
        'dzuhur : ' . $jsonHasilazancurl->jadwal->data->dzuhur . PHP_EOL .
        'ashar : ' . $jsonHasilazancurl->jadwal->data->ashar . PHP_EOL .
        'maghrib : ' . $jsonHasilazancurl->jadwal->data->maghrib . PHP_EOL .
        'isya : ' . $jsonHasilazancurl->jadwal->data->isya . PHP_EOL .
        'tanggal : ' . $jsonHasilazancurl->jadwal->data->tanggal,
);
function bahasa($translat_modul)
{
    global $lang_translate;
    return $lang_translate[$translat_modul];
}
