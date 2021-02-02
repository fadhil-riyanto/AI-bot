<?php
// if ($userID != $userid_pemilik) {
// 	$reply = '403 acces ditolak, yg bisa mengeksekusi command ini hanya @fadhil_riyanto. Command ini sedang tahap ujicoba';
// 	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// 	$telegram->sendMessage($content);
// 	exit;
// }
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = 'Gunakan pattern ' . PHP_EOL . '/quran {surah} {ayat}' . PHP_EOL . PHP_EOL . 'Contoh <pre>/quran al mulk 9</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $preg1_surah = preg_match('/([a-zA-Z_+\- ]+)\s([-+]?\s*\d+(?:\s*)+)/i', $udahDiparse, $hasilayat);
    if ($preg1_surah == 0) {
        preg_match('/([a-zA-Z_+\- ]+)/i', $udahDiparse, $hasilayat);
    }
    $qs_trimmed = rtrim($hasilayat[1], " ");
    function cariKodeNomorSurah($teks)
    {
        global $nomorSurah;
        global $ketSurah;
        global $artiSurah;
        global $ayatSurah;
        global $namaSurah;
        global $typeSurah;
        $listSurah = file_get_contents(__DIR__ . '/../json_data/quran/list_surat.json');
        $listSurah_dec = json_decode($listSurah);
        foreach ($listSurah_dec->hasil as $listSurah_for) {
            if (strtolower($listSurah_for->nama) == strtolower($teks)) {
                $nomorSurah = $listSurah_for->nomor;
                $ketSurah = $listSurah_for->keterangan;
                $artiSurah = $listSurah_for->arti;
                $ayatSurah = $listSurah_for->ayat;
                $namaSurah = $listSurah_for->nama;
                $typeSurah = $listSurah_for->type;
                return true;
            }
        }
        return false;
    }
    $angkaBoolQS = cariKodeNomorSurah($qs_trimmed);
    $angka = $nomorSurah;
    if (isset($hasilayat[2])) {
        $ayat = $hasilayat[2];
    }
    if ($angkaBoolQS == false) {
        $reply =  "ups, tidak ditemukan";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } elseif ($angkaBoolQS == true and empty($hasilayat[2])) {
        $reply =  '<b>' . $nomorSurah . '. ' . $namaSurah .  ' (' . $artiSurah . ')</b>' . PHP_EOL .
            $ayatSurah . ' Ayat, ' . $typeSurah .   PHP_EOL . PHP_EOL . strip_tags($ketSurah);
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } elseif ($angkaBoolQS == true || empty($hasilayat[2]) == false) {
        $qjson_get_data = file_get_contents(__DIR__ . '/../json_data/quran/'  . $angka . '.json');
        $a = json_decode($qjson_get_data);
        $reply = '<b>' . $nomorSurah . '. ' . $namaSurah .  ' (' . $artiSurah . ')</b>' . PHP_EOL .
            $ayatSurah . ' Ayat, ' . $typeSurah .   PHP_EOL . PHP_EOL .
            $a->$angka->text->$ayat . PHP_EOL . PHP_EOL .
            'Translate : ' . strip_tags($a->$angka->translations->id->text->$ayat);

        // $perbandinganAyatsatu = $ayat + 1;
        // $perbandinganAyatdua = $perbandinganAyatsatu - $a->$angka->number_of_ayah;
        // if ($perbandinganAyatdua <= 0) {
        //     $option = array(
        //         //First row
        //         array($telegram->buildInlineKeyBoardButton('Sebelumnya', $url = '', $callback_data = '/quran ' . $namaSurah . ' ' . $ayat - 1), $telegram->buildInlineKeyBoardButton('Selanjutnya', $url = '', $callback_data = '/start'))
        //         //Second row 
        //         // array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
        //         // //Third row
        //         // array($telegram->buildInlineKeyBoardButton("Button 6", $url = "http://link6.com"))
        //     );
        // } else {
        //     $option = array(
        //         //First row
        //         array($telegram->buildInlineKeyBoardButton('Sebelumnya', $url = '', $callback_data = '/quran'), $telegram->buildInlineKeyBoardButton('Selanjutnya', $url = '', $callback_data = '/start'))
        //         //Second row 
        //         // array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
        //         // //Third row
        //         // array($telegram->buildInlineKeyBoardButton("Button 6", $url = "http://link6.com"))
        //     );
        // }

        // $keyb = $telegram->buildInlineKeyBoard($option);
        // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        // $telegram->sendMessage($content);
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
unset($angka);
unset($reply);
