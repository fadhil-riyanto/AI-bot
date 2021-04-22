<?php
$lang_translate = array(
    'modul_start' => 'Hi! ' . $username . ', How are you? ' . PHP_EOL . 'I am a bot made by Fadhil Riyanto, if you don\'t understand what the commands in this bot are, you can write /help',
    'modul_adminlist_admin_tidak_ditemukan' => 'whoops, we can\'t find the admin'
);
function bahasa($translat_modul)
{
    global $lang_translate;
    return $lang_translate[$translat_modul];
}
