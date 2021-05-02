<?php
//define digunakan untuk mendefinisikan token bot kamu
define("TELEGRAM_TOKEN", "1655528859:AAH_PDfFdUHUBQQMgl6cYmREASE7JPuhWsI");

//file get contents digunakan untuk mengambil inputan yang dikirim pihak telegram
$dapatkan_input_json_dari_telegram = file_get_contents("php://input");

//setelah itu, data yang dikirim telegram, di decode untukd dijadikan array
$hasil = json_decode($dapatkan_input_json_dari_telegram, true);

//lalu memparse pesan, yaitu biar bisa dibedakan yang mana command, yang mana bagian text
//disini aku pake fungsi explode
$parse = explode(" ", $hasil['message']['text']);

//ini akan diambil command nya
$command = $parse[0]; //ambil array ke 0 karna di command
$text = str_replace($parse[0], "", $hasil['message']['text']); //lalu command dipotong untuk memisahkan nya
$chat_id = $hasil['message']['chat']['id']; //lalu ambil chat id orang nya

//lalu if else deh
if ($command == '/start') {
    kirim("hai, makasi yak dah start bot aku", $chat_id);
} elseif ($command == '/ngomong') {
    kirim($text, $chat_id);
}

//fungsi kirim ada 2 parameter, yaitu teks, dan chat id.
//fyi: di telegram untuk mengirim pesan, dibutuhkan chat id. layaknya alamat


//function untuk konsep dry (don't repeat your self)
function kirim($text, $chatid)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/sendMessage?chat_id=" . $chatid . "&text=" . urlencode($text));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    return $output;
}
