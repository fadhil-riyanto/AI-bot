<?php

function photo_oxy_class(array $data)
{
    $baseurl = $data['base'];
    $themed = '/' . $data['theme'];
    $text1 = $data['text_1'];
    $text2 = $data['text_2'];
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

    global $adanParse_plain, $text_plain, $adanParse, $telegram, $chat_id, $message_id;

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

$ngab = array(
    'base' => 'https://photooxy.com/',
    'theme' => 'logo-and-text-effects/make-tik-tok-text-effect-375.html',
    'text_1' => 'hmhehe',
    'text_2' => 'hmhmhm'
);

echo photo_oxy_class($ngab);
