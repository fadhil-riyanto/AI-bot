<?php

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

$watermarktext = $namaPertama . ' ' . $namaTerakhir;

function randomnamaandcek($length)
{
    $required_length = $length;
    $limit_one = rand();
    $limit_two = rand();
    $randomID = @substr(uniqid(sha1(crypt(md5(rand(min($limit_one, $limit_two), max($limit_one, $limit_two)))))), 0, $required_length);
    return $randomID;
}

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
$fileid = $result['message']['reply_to_message']['sticker']['file_id'];

if (isset($fileid)) {

    $getinfoDir = $telegram->getFile($fileid);
    $dirTgid = $getinfoDir['result']['file_path'];
    cek:
    $random  = randomnamaandcek(40);
    $a = file_exists('tmp/' . $random . '.png');
    if ($a == false) {
        $filenamehehe = 'tmp/' . $random . '.png';
        $downloadingimg = downloadUrlToFile('https://api.telegram.org/file/bot' . TG_HTTP_API . '/' . $dirTgid, $filenamehehe);
    } elseif ($a == true) {
        unset($random);
        goto cek;
    }
} else {
    $reply = 'maaf, anda harus mereply photo untuk di upload';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $editmsg = $telegram->sendMessage($content);
    exit;
}
$bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
$url        = $bot_url . "sendPhoto?chat_id=" . $chat_id;

$post_fields = array(
    'chat_id'   => $chat_id,
    'reply_to_message_id' => $message_id,
    'photo'     => new CURLFile(realpath($filenamehehe))
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
$output = curl_exec($ch);
