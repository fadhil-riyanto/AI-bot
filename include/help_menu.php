<?php
$reply = 'Hai ' . $username . ', Selamat datang di buku panduan bot ini' . PHP_EOL .
    'Anda dapat membaca panduan di bawah ini, dengan mengklik sebuah tombol dibawah.
Anda juga dapat mengajukan pertanyaan apa pun di Support group, harap diperhatikan bahwa Anda hanya dapat bertanya setelah membaca panduan, dan hanya bertanya tentang bot ini!

Perintah umum adalah:
- /start: Mulai bot
- /help: Berikan pesan ini

Semua perintah hanya bekerja dengan / (garis miring)';
$option = array(
    //First row
    array(
        $telegram->buildInlineKeyBoardButton("perkakas", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot perkakas'),
        $telegram->buildInlineKeyBoardButton("hash", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot hash'),
        $telegram->buildInlineKeyBoardButton("hiburan", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot hiburan')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("dev tools", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot dev_tools'),
        $telegram->buildInlineKeyBoardButton("admins", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot admins'),
        $telegram->buildInlineKeyBoardButton("bot ini", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot bot_ini')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("anime", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot anime')
        // ,
        // $telegram->buildInlineKeyBoardButton("admins", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot admins'),
        // $telegram->buildInlineKeyBoardButton("bot ini", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot bot_ini')
    )

);
$keyb = $telegram->buildInlineKeyBoard($option);
