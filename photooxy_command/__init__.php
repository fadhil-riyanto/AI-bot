<?php
function photo_oxy_class(array $data)
{
    global $adanParse_plain, $text_plain, $adanParse, $telegram, $chat_id, $message_id;
    $baseurl = $data['base'];
    $themed = '/' . $data['theme'];
    $text1 = $data['text_1'];
    $text2 = $data['text_2'];
    if (strlen($text1) <= 3) {
        $reply = "maaf, anda harus memasukkan lebih dari 3 karakter.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        if (isset($text2)) {
            $query1 = array(
                'text_1' => $text1,
                'text_2' => $text2
            );
            $query_build_1 = http_build_query($query1);
        } else {
            $query1 = array(
                'text_1' => $text1
            );
            $query_build_1 = http_build_query($query1);
        }



        require __DIR__ . '/../vendor/autoload.php';
        require __DIR__ . '/../include/simple_html_dom.php';
        $baseurldata = 'https://photooxy.com';
        $client = new GuzzleHttp\Client(['base_uri' => $baseurl]);
        $res = $client->request('POST', $themed . '?' . $query_build_1, ['allow_redirects' => false]);
        $htmls = $res->getBody();
        // echo $htmls;

        // // $html = str_get_html($htmls);
        // echo $htmls;
        $html = new simple_html_dom();
        $html->load($htmls);
        $text = $html->find('div[class=thumbnail]', 0)->innertext;
        preg_match_all('@src="([^"]+)"@', $text, $match);
        //var_dump($match);
        $urls = $baseurldata . $match[1][0];
        return $urls;
    }
}


if ($adanParse[0] == '/shadow_sky' ||  '/shadow_sky' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/make-quotes-under-grass-376.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/flower_cup' ||  '/flower_cup' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/write-text-on-the-cup-392.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/romantic_messages' ||  '/romantic_messages' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/romantic-messages-for-your-loved-one-391.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/burn_paper' ||  '/burn_paper' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/write-text-on-burn-paper-388.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/funny_cup' ||  '/funny_cup' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/put-text-on-the-cup-387.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/love_message' ||  '/love_message' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/create-a-picture-of-love-message-377.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/grass' ||  '/grass' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/make-quotes-under-grass-376.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/romantic_double_heart' ||  '/romantic_double_heart' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/love-text-effect-372.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/coffe' ||  '/coffe' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/put-any-text-in-to-coffee-cup-371.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/wood_love' ||  '/wood_love' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/write-art-quote-on-wood-heart-370.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/tiktok' ||  '/tiktok' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $toktokparse = explode('|', $udahDiparse);
        if ($toktokparse[1] == '') {
            $tek2 = 'by fadhil riyanto bot';
        } elseif (!isset($toktokparse[1])) {
            $tek2 = 'by fadhil riyanto bot';
        } else {
            $tek2 = $toktokparse[1];
        }
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/make-tik-tok-text-effect-375.html',
            'text_1' => $toktokparse[0],
            'text_2' => $tek2
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/flower_love' ||  '/flower_love' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/text-inside-the-flower-heart-369.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/wooden_boards' ||  '/wooden_boards' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/writing-on-wooden-boards-368.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/3d_summer' ||  '/3d_summer' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/3d-summer-text-effect-367.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/wolf_metal' ||  '/wolf_metal' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/create-a-wolf-metal-text-effect-365.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/nature_3d' ||  '/nature_3d' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/make-nature-3d-text-effects-364.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/underwater' ||  '/underwater' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/creating-an-underwater-ocean-363.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/golden_rose' ||  '/golden_rose' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/yellow-roses-text-360.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/summer_nature' ||  '/summer_nature' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/create-vector-nature-typography-355.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
} elseif ($adanParse[0] == '/typography_letters' ||  '/typography_letters' . USERNAME_BOT . '' == $adanParse[0]) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "maaf, anda harus memasukkan teks.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => 'logo-and-text-effects/create-a-layered-leaves-typography-text-effect-354.html',
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
}
