<?php
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if ($adanParse[1] == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Maaf, anda harus memasukkan teks nya' . PHP_EOL . PHP_EOL .
        'ontoh : /tiktok teks 1|teks 2';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
} else {
    $exp = explode('|', $udahDiparse);
    if (isset($exp[1]) == false) {
        $teks2 = 'by fadhil riyanto bot';
    }
    $teks = $exp[0];
    $teks2 = $exp[1];
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../include/simple_html_dom.php';
    $baseurldata = 'https://photooxy.com';
    $client = new GuzzleHttp\Client(['base_uri' => 'https://photooxy.com/']);
    $res = $client->request('POST', '/logo-and-text-effects/make-tik-tok-text-effect-375.html?text_1=' . $teks . '&text_2=' . $teks2, ['allow_redirects' => false]);
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
    $konten = array('chat_id' => $chat_id, 'photo' => $urls, 'caption' => 'gambar berhasil dibuat', 'reply_to_message_id' => $message_id,);
    $telegram->sendPhoto($konten);
}
