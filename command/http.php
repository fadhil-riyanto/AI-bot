<?php
$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus memasukkan input kode http yang ingin dicari.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $getfilenya = json_decode(file_get_contents(__DIR__ . '/../json_data/serv/http_code.json'));
    foreach ($getfilenya as $kode_http) {
        if (strtolower($kode_http->code) == strtolower($udahDiparse)) {
            $reply = $kode_http->code . '. ' . $kode_http->phrase . PHP_EOL . PHP_EOL .
                'Deskripsi : ' . $kode_http->description . PHP_EOL . PHP_EOL .
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
