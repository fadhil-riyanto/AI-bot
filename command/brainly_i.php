<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

if (isset($adanParse[1])) {
    $numbersPage = $adanParse[1];
}

$file = __DIR__ . "/../json_data/fitur_tambahan_json/brainly.json";
$anggota = file_get_contents($file);
$data = json_decode($anggota, true);
foreach ($data as $d) {
    if ($d['userid'] == $userID) {
        $idPesan = $d['msgid'];
        $lastPesan = $d['lastTanya'];
    }
}


$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
$pertanyaanParse = str_replace($adanParse_plain[0] . ' ' . $adanParse_plain[1] . ' ', '', $text_plain_nokarakter);

$watermarktext = $namaPertama . ' ' . $namaTerakhir;
if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan brainly, gunakan command <pre>/brainly {pertanyaan}</pre>' . PHP_EOL . PHP_EOL .
        'Contoh : <pre>/brainly penemu listrik</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $st = new Brainly($lastPesan);
    $result = $st->exec();
    if (count($result) == 0) {
        $a = file_get_contents('https://afara.my.id/api/brainly-scraper?q=' . urlencode($lastPesan));
        $result = json_decode($a);
    }

    if (count($result) === 0) {
        $reply = "tidak ditemukan!\n";
    } else {
        $hitungjumlahJawaban = count($result);
        $randomINt = $numbersPage;
        $reply = 'pertanyaan : ' . strip_tags($result[$randomINt]['content']) . PHP_EOL . PHP_EOL .
            'jawaban : ' . strip_tags($result[$randomINt]['answers'][0]);


        $numbersPagecallback = $numbersPage + 1;
        $option = array(
            array($telegram->buildInlineKeyBoardButton("Jawaban salah?", $url = "", $callback_data = '/brainly_i@fadhil_riyanto_bot ' . $numbersPagecallback . ' ' . $pertanyaanParse))
        );
        $keyb = $telegram->buildInlineKeyBoard($option);

        $content = array('chat_id' => $chat_id, 'text' => $reply, 'message_id' => $idPesan, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
        $msgUdahDikirim = $telegram->editMessageText($content);
    }
}
