<?php

use masokky\QuoteMaker;

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

$watermarktext = $namaPertama . ' ' . $namaTerakhir;
if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan quotes generator, gunakan command <pre>/q {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
        'Contoh : <pre>/q kamu bagaikan bunga dipagi hari</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    function generateRandomString_files($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    try {

        $randomstrings = generateRandomString_files(40);

        $text =  wordwrap($udahDiparse_hash, 20, "\n");
        (new QuoteMaker)
            ->setBackground(__DIR__ . '/../assets/quotesgen/img' . random_int(1, 30) . '.jpg')
            ->quoteText($text)
            ->watermarkText($watermarktext)
            ->setWatermarkFontSize(34)
            ->setQuoteFontSize(60)
            ->toFile('tmp/' . $randomstrings . '.png');

        $bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
        $url        = $bot_url . "sendPhoto?chat_id=" . $chat_id;

        $post_fields = array(
            'chat_id'   => $chat_id,
            'reply_to_message_id' => $message_id,
            'photo'     => new CURLFile(realpath('tmp/' . $randomstrings . '.png'))
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:multipart/form-data"
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        $output = curl_exec($ch);
        unlink('tmp/' . $randomstrings . '.png');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
