<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

$udahDiparse_hash = "jika trapesium abcd dan pqrs sebangun maka panjang bc adalah";
$st = new Brainly($udahDiparse_hash);
$results = $st->exec();
if (count($results) === 0) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://afara.my.id/api/brainly-scraper?q=' . urlencode($udahDiparse_hash));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $a = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($a, true);
} else {
}

if (count($results) === 0) {
    $reply = "tidak ditemukan!\n";
} else {
    $hitungjumlahJawaban = count($resulta);
    $randomINt = 0;
    $reply = 'pertanyaan : ' . strip_tags($results[$randomINt]['content']) . PHP_EOL . PHP_EOL .
        'jawaban : ' . strip_tags($results[$randomINt]['answers'][0]);
}
echo $reply;
