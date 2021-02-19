<?php
$reply = 'Hai ' . $username . ', Selamat datang di buku panduan bot ini' . PHP_EOL . 
'Anda dapat membaca panduan di bawah ini, dengan mengklik sebuah tombol dibawah.
Anda juga dapat mengajukan pertanyaan apa pun di Support group, harap diperhatikan bahwa Anda hanya dapat bertanya setelah membaca panduan, dan hanya bertanya tentang bot ini!

Perintah umum adalah:
- / start: Mulai bot
- / help: Berikan pesan ini

Semua perintah bekerja dengan /';
$option = array(
    //First row
    array(
        $telegram->buildInlineKeyBoardButton("tools dns", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot dns_tools'),
        $telegram->buildInlineKeyBoardButton("utility", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot utility')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("hash", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot hash'),
        $telegram->buildInlineKeyBoardButton("gabut", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot gabut')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("developer tools", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot dev_tools'),
        $telegram->buildInlineKeyBoardButton("admin command", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot admin_command')
    )

);
$keyb = $telegram->buildInlineKeyBoard($option);
