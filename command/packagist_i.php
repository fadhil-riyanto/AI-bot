<?php


// die();
$datas = explode(' ', $text_plain_nokarakter);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://packagist.org/search.json?q=" . urlencode(base64_decode($datas[3])) . "&page=" . $datas[2]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$packagist_keluar = json_decode($output, true);
if (count($packagist_keluar['results']) === 0) {
    $jawabquery = $telegram->getData();
    $alswecl = array('callback_query_id' => $jawabquery['callback_query']['id'], 'text' => 'maaf, halaman telah habis', 'show_alert' => true);
    $telegram->answerCallbackQuery($alswecl);
}
$urutan_nomor = 1;
foreach ($packagist_keluar['results'] as $packagist_hasil) {
    $datapackagist[] = $urutan_nomor . ". " . "nama : " . $packagist_hasil['name'] . PHP_EOL .
        "deksripsi : " . $packagist_hasil['description'] . PHP_EOL .
        "url : " . $packagist_hasil['url'] . PHP_EOL .
        "repo : " . $packagist_hasil['repository'] . PHP_EOL .
        "downloads : " . $packagist_hasil['downloads'] . PHP_EOL .
        "favers : " . $packagist_hasil['favers'];
    $urutan_nomor += 1;
}
$reply = implode(PHP_EOL . PHP_EOL, $datapackagist);
$option = array(
    array(
        $telegram->buildInlineKeyBoardButton("➡️", $url = "", $callback_data = "/packagist_i " . $datas[1] . " " . $datas[2] . " " . base64_encode($datas[3]))
    )
);
$keyb = $telegram->buildInlineKeyBoard($option);

$file = __DIR__ . "/../json_data/fitur_tambahan_json/packagist.json";
$anggota = file_get_contents($file);
$data = json_decode($anggota, true);
foreach ($data as $d) {
    if ($d['userid'] == $userID) {
        $idPesan = $d['msgid'];
    }
}
$content = array('chat_id' => $chat_id, 'text' => $reply, 'message_id' => $idPesan, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$msgUdahDikirim = $telegram->editMessageText($content);
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
