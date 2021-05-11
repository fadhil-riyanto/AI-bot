<?php

// $azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
// $udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
// $udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

// $watermarktext = $namaPertama . ' ' . $namaTerakhir;

// function randomnamaandcek($length)
// {
//     $required_length = $length;
//     $limit_one = rand();
//     $limit_two = rand();
//     $randomID = @substr(uniqid(sha1(crypt(md5(rand(min($limit_one, $limit_two), max($limit_one, $limit_two))), "rl"))), 0, $required_length);
//     return $randomID;
// }

// function downloadUrlToFile($url, $outFileName)
// {
//     if (is_file($url)) {
//         copy($url, $outFileName);
//     } else {
//         $options = array(
//             CURLOPT_FILE    => fopen($outFileName, 'w'),
//             CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
//             CURLOPT_URL     => $url
//         );

//         $ch = curl_init();
//         curl_setopt_array($ch, $options);
//         curl_exec($ch);
//         curl_close($ch);
//     }
// }

// $result = $telegram->getData();
// $fileid = $result['message']['reply_to_message']['sticker']['file_id'];

// if (isset($fileid)) {

//     $getinfoDir = $telegram->getFile($fileid);
//     $dirTgid = $getinfoDir['result']['file_path'];
//     cek:
//     $random  = randomnamaandcek(40);
//     $a = file_exists('tmp/sticker_rev_' . $random . '.webp');
//     if ($a == false) {
//         $filenamehehe = 'tmp/sticker_rev_' . $random . '.webp';
//         $downloadingimg = downloadUrlToFile('https://api.telegram.org/file/bot' . TG_HTTP_API . '/' . $dirTgid, $filenamehehe);
//     } elseif ($a == true) {
//         unset($random);
//         goto cek;
//     }
// } else {
//     $reply = 'maaf, anda harus mereply stker untuk dianalisis';
//     $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
//     $editmsg = $telegram->sendMessage($content);
//     exit;
// }


// //$bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
// $url        = 'https://telegra.ph/upload';

// if ($usernameBelumdiparse != null) { //Jika user ada usernamenya
//     $imgname = ' @' . $usernameBelumdiparse;
// } else { //ini user aneh, username gaada.....
//     $imgname =  '[\'no_username\']' . $namaPertama . ' ' . $namaTerakhir;
// }

// $im = imagecreatefromwebp(__DIR__.'/../tmp/sticker_rev_' . $random . '.webp');
// imagepng('tmp/sticker_rev_jadi_' . $random . '.png', 100);
// imagedestroy($im);

// $post_fields = array(
//     // 'key'   => IMGBB_API,
//     // 'name' => 'by-fadhil-riyanto-bot',
//     // 'image'     => new CURLFile(realpath('tmp/sticker_rev_.png'))
//     'file'     => new CURLFile(realpath('tmp/sticker_rev_jadi_' . $random . '.png'))
// );

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     "Content-Type:multipart/form-data"
// ));
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
// $output = curl_exec($ch);

// //$imageurlresult = 'https://telegra.ph'  . json_decode($output)[0]->src;
// //form
// $option = array(
//     array(
//         $telegram->buildInlineKeyBoardButton("google", $url = "https://www.google.com/searchbyimage?image_url=" . $imageurlresult),
//         $telegram->buildInlineKeyBoardButton("Bing", $url = "https://www.bing.com/images/search?q=imgurl:" . $imageurlresult . "&view=detailv2&selectedindex=0&mode=ImageViewer&iss=sbi")
//     )
// );
// $keyb = $telegram->buildInlineKeyBoard($option);

// $hasilbagus = $output;
// $content = array('chat_id' => $chat_id, 'message_id' => $editmsg['result']['message_id'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => false);
// $telegram->sendMessage($content);


// unlinkFile('tmp/sticker_rev_' . $random . '.png');
// unlinkFile('tmp/sticker_rev_jadi_' . $random . '.png');
