<?php
$lang_translate = array(
    'modul_start' => 'Haii ' . $username . ', Apa kabar? ' . PHP_EOL . 'Saya bot buatan fadhil riyanto, jika kamu belom paham apa saja command di bot ini, kamu bisa tulis /help',
    'modul_adminlist_admin_tidak_ditemukan' => 'ups, admin tidak bisa kami ditemukan'
);
function bahasa($translat_modul)
{
    global $lang_translate;
    return $lang_translate[$translat_modul];
}
