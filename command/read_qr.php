<?php
require __DIR__ . '/../vendor/autoload.php';

use Zxing\QrReader;

function downloadUrlToFile($url, $outFileName)
{
    if (is_file($url)) {
        copy($url, $outFileName);
    } else {
        $options = array(
            CURLOPT_FILE    => fopen($outFileName, 'w'),
            CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
            CURLOPT_URL     => $url
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        curl_close($ch);
    }
}


$result = $telegram->getData();
$fileid = $result['message']['reply_to_message']['document']['file_id'];
if (isset($fileid)) {
} else {
    $getResolutionfileid = end($result['message']['reply_to_message']['photo']);
    $fileid = $getResolutionfileid['file_id'];
}
if (isset($fileid)) {
    $getinfoDir = $telegram->getFile($fileid);
    $dirTgid = $getinfoDir['result']['file_path'];
    $downloadingimg = downloadUrlToFile('https://api.telegram.org/file/bot' . TG_HTTP_API . '/' . $dirTgid, 'tmp/qr_user_temp.png');


    $qrcode = new QrReader('tmp/qr_user_temp.png');
    $text = $qrcode->text();
    if ($text == false) {
        $reply = 'Hai ' . $username . ', Maaf Kami tidak bisa membaca file nya...';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;
    }
    $reply = 'Hai ' . $username . ', hasil read qr code adalah' . PHP_EOL . PHP_EOL . '<pre>' . htmlspecialchars($text) . '</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $reply = 'Hai ' . $username . ', untuk menggunakan qr code reader. anda harus mereply foto dengan command /read_qr';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}

// $qrcode = new QrReader(__DIR__ . '/../tmp/qrtemp.png');
// $text = $qrcode->text();
// echo $text;
