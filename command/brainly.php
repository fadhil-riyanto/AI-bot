<?php
require __DIR__ . '/../vendor/autoload.php';

use Brainly\Brainly;

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan brainly, gunakan command <pre>/brainly {pertanyaan}</pre>' . PHP_EOL . PHP_EOL .
        'Contoh : <pre>/brainly penemu listrik</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $st = new Brainly($udahDiparse_hash);
    $result = $st->exec();
    if (count($result) === 0) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://afara.my.id/api/brainly-scraper?q=' . urlencode($udahDiparse_hash));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $a = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($a, true);
    } else {
    }

    if (count($result) === 0) {
        $reply = "tidak ditemukan!";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
        $urlCall = $telegram->sendMessage($content);
    } else {
        $hitungjumlahJawaban = count($result);
        $randomINt = 0;
        $reply = 'pertanyaan : ' . strip_tags($result[$randomINt]['content']) . PHP_EOL . PHP_EOL .
            'jawaban : ' . strip_tags($result[$randomINt]['answers'][0]);

        $option = array(
            array($telegram->buildInlineKeyBoardButton("Jawaban salah?", $url = "", $callback_data = '/brainly_i@fadhil_riyanto_bot 1 ' . $userID))
        );
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
        $urlCall = $telegram->sendMessage($content);
        $msgidUntukedit = $urlCall['result']['message_id'];
        function getUseridFromeditmessage($userID)
        {
            $file = __DIR__ . "/../json_data/fitur_tambahan_json/brainly.json";
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
            $file = __DIR__ . "/../json_data/fitur_tambahan_json/brainly.json";
            $anggota = file_get_contents($file);
            $data = json_decode($anggota, true);
            foreach ($data as $key => $d) {
                if ($d['userid'] === $userID) {
                    $data[$key]['msgid'] = $msgidUntukedit;
                    $data[$key]['count_answer'] = 1;
                    $data[$key]['jawaban'] = $result;
                }
            }
            $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
            $anggota = file_put_contents($file, $jsonfile);
        } elseif ($cheker == null) {
            $file = __DIR__ . "/../json_data/fitur_tambahan_json/brainly.json";
            $anggota = file_get_contents($file);
            $data = json_decode($anggota, true);

            $data[] = array(
                "userid" => $userID,
                "msgid" => $msgidUntukedit,
                "count_answer" => 1,
                "jawaban" => $result

            );

            $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
            $anggota = file_put_contents($file, $jsonfile);
        }
    }
}
