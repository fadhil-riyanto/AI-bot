<?php
$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus memasukkan input method yang ingin dicari.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $getfilenya = json_decode(file_get_contents(__DIR__ . '/../json_data/serv/method.json'));
    foreach ($getfilenya as $kode_http) {
        if (strtolower($kode_http->method) == strtolower($udahDiparse)) {
            $converted_res = $kode_http->safe ? 'true' : 'false';
            $converted_res_idempotent = $kode_http->idempotent ? 'true' : 'false';
            $converted_res_cacheable = $kode_http->cacheable ? 'true' : 'false';
            $reply =
                'desc : ' . $kode_http->description . PHP_EOL . PHP_EOL .
                'safe : ' . $converted_res_idempotent . PHP_EOL .
                'cacheable : ' . $converted_res_cacheable . PHP_EOL .
                '<a href="' . $kode_http->spec_href . '">' . $kode_http->spec_title . '</a>';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
            exit;
        }
    }
    $reply = 'kode http tidak ditemukan';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
