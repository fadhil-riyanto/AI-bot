<?php
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

$hash_cek = hash_file('md5', 'https://cdn.statically.io/screenshot/' . hapus_http($udahDiparse));

if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan capture, gunakan command <pre>/capture {domain or IP}</pre>' . PHP_EOL . PHP_EOL .  'Contoh : <pre>/capture google.com</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif ($udahDiparse != null) {

    if ($hash_cek == '9c60b52f2f14216bf26f6685c2f25283') {
        // $reply = '1';
        // $content = array('chat_id' => $chat_id, 'photo' => 'https://cdn.statically.io/screenshot/google.com');
        // $telegram->sendPhoto($content);
        $reply = 'Maaf, kami tidak bisa mendapatkan gambar nya. Mungkin url kamu salah atau mungkin server yang tidak aktif. Kamu bisa coba mengeja kembali atau menambahkan WWW didepan nya';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $content = array('chat_id' => $chat_id, 'photo' => 'https://cdn.statically.io/screenshot/' . hapus_http($udahDiparse), 'reply_to_message_id' => $message_id);
        $telegram->sendPhoto($content);
    }
}
exit;
