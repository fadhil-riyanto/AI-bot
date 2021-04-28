<?php
$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus memasukkan input media type yang ingin dicari." . PHP_EOL . "contoh : ";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $getfilenya = json_decode(file_get_contents(__DIR__ . '/../json_data/serv/media_type.json'));
    foreach ($getfilenya as $kode_http) {
        if (strtolower($kode_http->media_type) == strtolower($udahDiparse)) {
            $reply =
                'template : ' . $kode_http->template . PHP_EOL . PHP_EOL .
                '<a href="' . $kode_http->spec_href . '">' . $kode_http->spec_title . '</a>';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
            exit;
        }
    }
    $reply = 'kode media tidak ditemukan tidak ditemukan';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
