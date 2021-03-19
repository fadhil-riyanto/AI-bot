<?php
function themeddatas($string)
{
    $string = strtolower($string);
    $dict = array(
        'shadow' => 'logo-and-text-effects/shadow-text-effect-in-the-sky-394.html',
        'csharp' => '1',
        'vb_net' => '2',
        'vb' => '2',
        'visual_basic_dotnet' => '2',
        'fpc' => '9',
        'objective_c' => '10',
        'objective-c' => '10',
        'objc' => '10',
        'clojure' => '47'
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}
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


$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus memasukkan teks.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $konf = themeddatas($adanParse_plain_nokarakter[0]);
    if ($konf == false) {
    } else {
        $ngab = array(
            'base' => 'https://photooxy.com/',
            'theme' => $konf,
            'text_1' => $udahDiparse
        );

        $urlss = photo_oxy_class($ngab);
        $konten = array('chat_id' => $chat_id, 'photo' => $urlss, 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
        $telegram->sendPhoto($konten);
    }
}
