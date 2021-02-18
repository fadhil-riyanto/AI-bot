<?php

use Endroid\QrCode\QrCode;

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan qrcode generator, gunakan command <pre>/qr_code {isi}</pre>' . PHP_EOL . PHP_EOL .
        'Contoh : <pre>/qr_code indonesia</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $qrCode = new QrCode($udahDiparse_hash);
    $qrCode->writeFile('tmp/qrtemp.png');

    $bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
    $url        = $bot_url . "sendDocument?chat_id=" . $chat_id;

    $post_fields = array(
        'chat_id'   => $chat_id,
        'reply_to_message_id' => $message_id,
        'document'     => new CURLFile(realpath('tmp/qrtemp.png'))
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type:multipart/form-data"
    ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $output = curl_exec($ch);
}
