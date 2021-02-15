<?php
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://afara.my.id/api/brainly-scraper?q=' . urlencode($udahDiparse_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$a = curl_exec($ch);
curl_close($ch);
$result = json_decode($a, true);

if (count($result) === 0) {
    $reply = "tidak ditemukan!";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
    $urlCall = $telegram->sendMessage($content);
} else {
    $hitungjumlahJawaban = count($result);
    $randomINt = 0;
    $reply = 'pertanyaans : ' . strip_tags($result[$randomINt]['content']) . PHP_EOL . PHP_EOL .
        'jawaban : ' . strip_tags($result[$randomINt]['answers'][0]);


    $option = array(
        array($telegram->buildInlineKeyBoardButton("Jawaban salah?", $url = "", $callback_data = '/brainly_i@fadhil_riyanto_bot 1 ' . $udahDiparse_hash))
    );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $urlCall = $telegram->sendMessage($content);
}
