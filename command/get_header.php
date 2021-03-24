<?php

$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "ups, anda harus memasukkan domain yang ingin di whois.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $head = get_headers($udahDiparse, 1);
    if ($head == null) {
        $reply = "maaf, header tidak ditemukan.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        foreach ($head['Content-Type'] as $contenttype) {
            $hasil_contenttype[] = '👉 ' . $contenttype . PHP_EOL;
        }
        foreach ($head['Date'] as $Date) {
            $hasil_Date[] = '👉 ' . $Date . PHP_EOL;
        }
        foreach ($head['Expires'] as $Expires) {
            $hasil_Expires[] = '👉 ' . $Expires . PHP_EOL;
        }
        foreach ($head['Cache-Control'] as $CacheControl) {
            $hasil_CacheControl[] = '👉 ' . $CacheControl . PHP_EOL;
        }
        foreach ($head['Server'] as $Server) {
            $hasil_Server[] = '👉 ' . $Server . PHP_EOL;
        }
        foreach ($head['Content-Length'] as $ContentLength) {
            $hasil_ContentLength[] = '👉 ' . $ContentLength . PHP_EOL;
        }
        $template = $head[0] . PHP_EOL . PHP_EOL .
            'Tipe konten : ' . PHP_EOL . implode('', $hasil_contenttype) . PHP_EOL .
            'Tanggal : ' . PHP_EOL . implode('', $hasil_Date) . PHP_EOL .
            'Kadaluarsa : ' . PHP_EOL . implode('', $hasil_Expires) . PHP_EOL .
            'Cache : ' . PHP_EOL . implode('', $hasil_CacheControl) . PHP_EOL .
            'Server : ' . PHP_EOL . implode('', $hasil_Server) . PHP_EOL .
            'Panjang : ' . PHP_EOL . $head['Content-Length'] . PHP_EOL .
            'XSS protect : ' . PHP_EOL . implode(PHP_EOL, $head['X-XSS-Protection']) . PHP_EOL .
            'X-Frame : ' . PHP_EOL . implode(PHP_EOL, $head['X-Frame-Options']) . PHP_EOL .
            'Alt-Svc : ' . PHP_EOL . implode(PHP_EOL, $head['Alt-Svc']) . PHP_EOL .
            'code : ' . PHP_EOL . $head[1] . PHP_EOL .
            'P3P : ' . PHP_EOL . $head['P3P'] . PHP_EOL .
            'Set-Cookie : ' . PHP_EOL . implode(PHP_EOL, $head['Set-Cookie']) . PHP_EOL .
            'Accept-Ranges : ' . PHP_EOL . implode(PHP_EOL, $head['Accept-Ranges']) . PHP_EOL .
            'Vary : ' . PHP_EOL .  $head['Vary'] . PHP_EOL;
        $reply = $template;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
