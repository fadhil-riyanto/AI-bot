<?php

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

$watermarktext = $namaPertama . ' ' . $namaTerakhir;

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
    $reply = 'Tunggu sebentar, kami sedang mengupload image (sync)';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $editmsg = $telegram->sendMessage($content);

    $getinfoDir = $telegram->getFile($fileid);
    $dirTgid = $getinfoDir['result']['file_path'];
    $downloadingimg = downloadUrlToFile('https://api.telegram.org/file/bot' . TG_HTTP_API . '/' . $dirTgid, 'tmp/pict_uploader.png');
} else {
    $reply = 'maaf, anda harus mereply photo untuk di upload';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $editmsg = $telegram->sendMessage($content);
    exit;
}

//$bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
$url        = 'https://api.imgbb.com/1/upload';

if ($usernameBelumdiparse != null) { //Jika user ada usernamenya
    $imgname = ' @' . $usernameBelumdiparse;
} else { //ini user aneh, username gaada.....
    $imgname =  '[\'no_username\']' . $namaPertama . ' ' . $namaTerakhir;
}

$post_fields = array(
    'key'   => IMGBB_API,
    'name' => 'by-fadhil-riyanto-bot',
    'image'     => new CURLFile(realpath('tmp/pict_uploader.png'))
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
$output = curl_exec($ch);
$hasilbagus = 'Ogey, link nya ini .. ' . json_decode($output)->data->url;
$content = array('chat_id' => $chat_id, 'message_id' => $editmsg['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->editMessageText($content);
