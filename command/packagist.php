<?php
$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus package yang akan dicari di packagist.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://packagist.org/search.json?q=" . urlencode($udahDiparse));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $packagist_keluar = json_decode($output, true);
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
            $telegram->buildInlineKeyBoardButton("➡️", $url = "", $callback_data = "/packagist_i " . $userID . " 2 " . base64_encode($udahDiparse))
        )
    );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $urlCall = $telegram->sendMessage($content);
    //die();,
    $msgidUntukedit = $urlCall['result']['message_id'];
    function getUseridFromeditmessage($userID)
    {
        $file = __DIR__ . "/../json_data/fitur_tambahan_json/packagist.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        foreach ($data as $d) {
            if ($d['userid'] == $userID) {
                return true;
            }
        }
    }
    $cheker = getUseridFromeditmessage($userID);
    if ($cheker == true) {
        $file = __DIR__ . "/../json_data/fitur_tambahan_json/packagist.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['userid'] === $userID) {
                $data[$key]['msgid'] = $msgidUntukedit;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    } elseif ($cheker == null) {
        $file = __DIR__ . "/../json_data/fitur_tambahan_json/packagist.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);

        $data[] = array(
            "userid" => $userID,
            "msgid" => $msgidUntukedit
        );

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    }
}
