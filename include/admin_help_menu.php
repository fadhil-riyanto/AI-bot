<?php
$reply = 'Hai ' . $username . ', Selamat datang di panduan bot management' . PHP_EOL .PHP_EOL .
    'perlu diperhatikan bahwa bot ini tidak akan bisa di invite ke grup tanpa persetujuan dari pembuat bot. dan, command grup management dibawah ini khusus untuk grup yang sudah diijinkan masuk oleh pembuat bot ini.' . PHP_EOL . PHP_EOL . 
	'jika mau mengivite bot ini ke grup anda, silahkan kirimkan angka chat id grup anda lalu pm (private message) ke pembuat bot ini, yaitu ' . PUMBUAT_BOT . '

note : Semua perintah hanya bekerja dengan / (garis miring)';
$option = array(
    //First row
    array(
        $telegram->buildInlineKeyBoardButton("Grettings", $url = "", $callback_data = '/callback_q_admin_help@fadhil_riyanto_bot grettings'),
        $telegram->buildInlineKeyBoardButton("Rules", $url = "", $callback_data = '/callback_q_admin_help@fadhil_riyanto_bot rules'),
        $telegram->buildInlineKeyBoardButton("Admins", $url = "", $callback_data = '/callback_q_admin_help@fadhil_riyanto_bot admins')
    ),
    /*array(
        $telegram->buildInlineKeyBoardButton("dev tools", $url = "", $callback_data = '/callback_q_admin_help@fadhil_riyanto_bot dev_tools'),
        //$telegram->buildInlineKeyBoardButton("admins", $url = "", $callback_data = '/transformasi_help@fadhil_riyanto_bot'),
		$telegram->buildInlineKeyBoardButton("anime", $url = "", $callback_data = '/callback_q_admin_help@fadhil_riyanto_bot anime'),
        $telegram->buildInlineKeyBoardButton("bot ini", $url = "", $callback_data = '/callback_q_admin_help@fadhil_riyanto_bot bot_ini')
    ),*/
    //array(
        //$telegram->buildInlineKeyBoardButton("anime", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot anime')
        // ,
        // $telegram->buildInlineKeyBoardButton("admins", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot admins'),
        // $telegram->buildInlineKeyBoardButton("bot ini", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot bot_ini')
    //)

);
$keyb = $telegram->buildInlineKeyBoard($option);
