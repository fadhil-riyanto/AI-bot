<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;


$file = __DIR__ . "/../json_data/fitur_tambahan_json/brainly.json";
$anggota = file_get_contents($file);
$data = json_decode($anggota, true);
foreach ($data as $d) {
    if ($d['userid'] == $userID) {
        $idPesan = $d['msgid'];
        $lastPesan = $d['count_answer'];
        $jawabanJson = $d['jawaban'];
    }
}


// $azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
// $udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
// $udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
// $pertanyaanParse = str_replace($adanParse_plain[0] . ' ' . $adanParse_plain[1] . ' ', '', $text_plain_nokarakter);

// $watermarktext = $namaPertama . ' ' . $namaTerakhir;
// if ($azanHilangcommand == null) {
//     $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan brainly, gunakan command <pre>/brainly {pertanyaan}</pre>' . PHP_EOL . PHP_EOL .
//         'Contoh : <pre>/brainly penemu listrik</pre>';
//     $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
//     $telegram->sendMessage($content);
// } else {
// $st = new Brainly($lastPesan);
// $result = $st->exec();
// if (count($result) == 0) {
//     $a = file_get_contents('https://afara.my.id/api/brainly-scraper?q=' . urlencode($lastPesan));
$result = $jawabanJson;
// }

if (count($result) === 0) {
    $reply = "tidak ditemukan!\n";
} else {
    $hitungjumlahJawaban = count($result);
    $randomINt = $lastPesan;
    $reply = 'pertanyaan : ' . strip_tags($result[$randomINt]['content']) . PHP_EOL . PHP_EOL .
        'jawaban : ' . strip_tags($result[$randomINt]['answers'][0]);


    $numbersPagecallback = $lastPesan + 1;

    $file = __DIR__ . "/../json_data/fitur_tambahan_json/brainly.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $key => $d) {
        if ($d['userid'] === $userID) {

            $data[$key]['count_answer'] = $numbersPagecallback;
        }
    }
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);

    $option = array(
        array($telegram->buildInlineKeyBoardButton("Jawaban salah?", $url = "", $callback_data = '/brainly_i@fadhil_riyanto_bot'))
    );
    $keyb = $telegram->buildInlineKeyBoard($option);

    $content = array('chat_id' => $chat_id, 'text' => $reply, 'message_id' => $idPesan, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
    $msgUdahDikirim = $telegram->editMessageText($content);
}
// }
