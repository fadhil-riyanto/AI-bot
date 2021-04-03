<?php
require __DIR__  . '/../vendor/autoload.php';

use \Treinetic\ImageArtist\lib\Shapes\Triangle;
use \Treinetic\ImageArtist\lib\Shapes\PolygonShape;
use \Treinetic\ImageArtist\lib\Commons\Node;
use \Treinetic\ImageArtist\lib\Text\Color;
use \Treinetic\ImageArtist\lib\Overlays\Overlay;
use \Treinetic\ImageArtist\lib\Shapes\CircularShape;
use \Treinetic\ImageArtist\lib\Text\TextBox;
use \Treinetic\ImageArtist\lib\Text\Font;

/*
 * Merge images
 * */

$content = array('user_id' => $userID);
$editmsg = $telegram->getUserProfilePhotos($content);
$fileid = $editmsg['result']['photos'][0][2]['file_id'];

// $reply = json_encode($fileid);
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
// exit;

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

$randomstrings = generateRandomString_files(40);

$getinfoDir = $telegram->getFile($fileid);
$dirTgid = $getinfoDir['result']['file_path'];
$downloadingimg = downloadUrlToFile('https://api.telegram.org/file/bot' . TG_HTTP_API . '/' . $dirTgid, __DIR__ . '/../tmp/pict_user_' . $randomstrings . '.png');


$tr1 = new Triangle(__DIR__ . "/../assets/me_photo/city.jpg");
$tr1->scale(64);
$tr1->setPointA(0, 0, true);
$tr1->setPointB(100, 0, true);
$tr1->setPointC(100, 100, true);
$tr1->build();

$tr2 = new Triangle(__DIR__ . "/../assets/me_photo/morning.jpeg");
$tr2->scale(60);
$tr2->setPointA(0, 0, true);
$tr2->setPointB(0, 100, true);
$tr2->setPointC(100, 100, true);
$tr2->build();

$tr1->resize($tr1->getWidth(), $tr2->getHeight());

$img = $tr1->merge($tr2, 0, 0);
$img->scale(70);


/* Let's add an overlay to this */
$overlay = new Overlay($img->getWidth(), $img->getHeight(), new Color(0, 0, 0, 80));
$img->merge($overlay, 0, 0);
/* hmmm.. lets add a photo */
$circle = new CircularShape(__DIR__ . '/../tmp/pict_user_' . $randomstrings . '.png');
$circle->resize(300, 300);
$circle->build();
$img = $img->merge($circle, ($img->getWidth() - $circle->getWidth()) / 2, ($img->getHeight() - $circle->getHeight()) / 2);
/* I think I should add some Text */
$textBox = new TextBox(310, 40);
$textBox->setColor(Color::getColor(Color::$WHITE));
$textBox->setFont(Font::getFont(Font::$NOTOSERIF_REGULAR));
$textBox->setSize(20);
$textBox->setMargin(2);
$img->setTextBox($textBox, ($img->getWidth() - $textBox->getWidth()) / 2, $img->getHeight() * (5 / 7));

//$img->dump();
$img->convertTo(IMAGETYPE_PNG);
$img->save('tmp/' . $randomstrings . '.png', IMAGETYPE_PNG);

$bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
$url        = $bot_url . "sendPhoto?chat_id=" . $chat_id;

$lang = $telegram->getData();
$l = $lang['message']['from']['language_code'];
$capt = 'Profile saya' . PHP_EOL . PHP_EOL .
    '🔖 ID User : ' . $userID . PHP_EOL .
    '├Nama : ' . $namaPertama . ' ' . $namaTerakhir . PHP_EOL .
    '├Username : ' . $username . PHP_EOL .
    '└Bahasa : ' . $l;
$post_fields = array(
    'caption' => $capt,
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
