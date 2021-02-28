<?php
function random_angka_digit($digits)
{
    return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
}

$keylist_chapcha_atas0 = array(
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton('ini', $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help")
);
$keylist_chapcha_atas1 = array(
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help")
);

$keylist_chapcha_bawah0 = array(
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help")
);
$keylist_chapcha_bawah1 = array(
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton('ini', $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help"),
    $telegram->buildInlineKeyBoardButton(random_angka_digit(4), $url = "",  $callback_data = "/help")
);
//bagian atas
shuffle($keylist_chapcha_atas0);
shuffle($keylist_chapcha_atas1);
$option0 = array($keylist_chapcha_atas0, $keylist_chapcha_atas1);

//bagian bawah
shuffle($keylist_chapcha_bawah0);
shuffle($keylist_chapcha_bawah1);
$option1 = array($keylist_chapcha_bawah0, $keylist_chapcha_bawah1);

$randomatasbawah = array($option0, $option1);
$keyb = $telegram->buildInlineKeyBoard($randomatasbawah[random_int(0, 1)]);
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
$telegram->sendMessage($content);
