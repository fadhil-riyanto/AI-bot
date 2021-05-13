<?php
$option = array(
    array(
        $telegram->buildInlineKeyBoardButton("AC", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' ac')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("7", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 7'),
        $telegram->buildInlineKeyBoardButton("8", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 8'),
        $telegram->buildInlineKeyBoardButton("9", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 9'),
        $telegram->buildInlineKeyBoardButton("/", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' /')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("4", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 4'),
        $telegram->buildInlineKeyBoardButton("5", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 5'),
        $telegram->buildInlineKeyBoardButton("6", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 6'),
        $telegram->buildInlineKeyBoardButton("*", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' *')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("1", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 1'),
        $telegram->buildInlineKeyBoardButton("2", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 2'),
        $telegram->buildInlineKeyBoardButton("3", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 3'),
        $telegram->buildInlineKeyBoardButton("-", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' -')
    ),
    array(
        $telegram->buildInlineKeyBoardButton("0", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' 0'),
        $telegram->buildInlineKeyBoardButton("=", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' ='),
        $telegram->buildInlineKeyBoardButton("+", $url = "", $callback_data = '/calc_fadhilsystem_i@fadhil_riyanto_bot ' . $userID . ' +')
    )
);
$keyb = $telegram->buildInlineKeyBoard($option);
