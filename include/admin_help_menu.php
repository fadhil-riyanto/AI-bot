<?php
$reply = 'semua kategori group management command';
$option = array(
    //First row
    array(
        $telegram->buildInlineKeyBoardButton("admins", $url = "", $callback_data = '/admin_callback_q@fadhil_riyanto_bot admin'),
        $telegram->buildInlineKeyBoardButton("grettings", $url = "", $callback_data = '/admin_callback_q@fadhil_riyanto_bot grettings'),
        $telegram->buildInlineKeyBoardButton("notes", $url = "", $callback_data = '/admin_callback_q@fadhil_riyanto_bot notes')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("info", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot info'),
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
