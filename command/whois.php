<?php

$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "ups, anda harus memasukkan domain yang ingin di whois.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    if (strlen($udahDiparse) > 4094) {
        $reply = "ups, jumlah karakter diperbolehkan hanya 4096 huruf.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;
    }
	include __DIR__ . '/../include/src_ppwhois/Phois/Whois/Whois.php';
	$sld = $udahDiparse;
	$domain = new Phois\Whois\Whois($sld);
	$whois_answer = $domain->info();

	$reply = $whois_answer;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
}
