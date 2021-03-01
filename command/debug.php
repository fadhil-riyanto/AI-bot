<?php

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

$phraseBuilder = new PhraseBuilder(4, '0123456789');
$builder = new CaptchaBuilder(null, $phraseBuilder);
$builder->build($width = 300, $height = 80, $font = null);
$builder->save(__DIR__ . '/../tmp/out.jpg');

function random_angka_digit($digits)
{
    return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
}

$jawabanchapcha = $builder->getPhrase();

//JSON penyimpanan
function getUseridFromeditmessage($userID)
{
    global $chat_id;
    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID && $d['chatid'] == $chat_id) {
            return true;
        }
    }
}
$cheker = getUseridFromeditmessage($userID);
if ($cheker == true) {
    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $key => $d) {
        if ($d['userid'] === $userID) {
            $data[$key]['pharse'] = $jawabanchapcha;
            $data[$key]['percobaan'] = 1;
        }
    }
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
} elseif ($cheker == null) {
    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);

    $data[] = array(
        "userid" => $userID,
        "chatid" => $chat_id,
        "pharse" => $jawabanchapcha,
        "percobaan" => 1
    );

    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
}


//Keyboard ===================================
//generate randomm angka
$numrandkeyboard1 = random_angka_digit(4);
$numrandkeyboard2 = random_angka_digit(4);
$numrandkeyboard3 = random_angka_digit(4);
$numrandkeyboard4 = random_angka_digit(4);
$numrandkeyboard5 = random_angka_digit(4);
$numrandkeyboard6 = random_angka_digit(4);
$numrandkeyboard7 = random_angka_digit(4);
$numrandkeyboard8 = random_angka_digit(4);
$numrandkeyboard9 = random_angka_digit(4);

$keylist_chapcha_atas0 = array(
    $telegram->buildInlineKeyBoardButton($numrandkeyboard1, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard1),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard2, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard2),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard3, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard3),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard4, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard4),
    $telegram->buildInlineKeyBoardButton($jawabanchapcha, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $jawabanchapcha)
);
$keylist_chapcha_atas1 = array(
    $telegram->buildInlineKeyBoardButton($numrandkeyboard5, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard5),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard6, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard6),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard7, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard7),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard8, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard8),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard9, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard9)
);

$keylist_chapcha_bawah0 = array(
    $telegram->buildInlineKeyBoardButton($numrandkeyboard5, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard5),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard6, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard6),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard7, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard7),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard8, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard8),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard9, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard9)
);
$keylist_chapcha_bawah1 = array(
    $telegram->buildInlineKeyBoardButton($numrandkeyboard1, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard1),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard2, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard2),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard3, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard3),
    $telegram->buildInlineKeyBoardButton($numrandkeyboard4, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard4),
    $telegram->buildInlineKeyBoardButton($jawabanchapcha, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $jawabanchapcha)
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
//kirim gambar
$bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
$url        = $bot_url . "sendPhoto?chat_id=" . $chat_id;

$post_fields = array(
    'chat_id'   => $chat_id,
    'reply_to_message_id' => $message_id,
    'reply_markup' => $keyb,
    'caption' => "Klik angka yang sama dengan gambar, anda memiliki kesempatan 3 kali!",
    'photo'     => new CURLFile(realpath('tmp/out.jpg'))
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
$output = curl_exec($ch);


// $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
// $telegram->sendMessage($content);
