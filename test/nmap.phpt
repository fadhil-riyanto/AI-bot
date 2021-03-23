<?php
$teks = 'ngetes';
$teks2 = 'ngetes';
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../include/simple_html_dom.php';
$baseurldata = 'https://photooxy.com';
$client = new GuzzleHttp\Client(['base_uri' => 'https://osint.sh/']);
$res = $client->request('POST', '/nmap/?domain=t.me&submit=', ['allow_redirects' => false]);
$htmls = $res->getBody();
echo $htmls;

// $html = str_get_html($htmls);
// // echo $htmls;
// $html = new simple_html_dom();
// $html->load($htmls);
// $text = $html->find('pre')->innertext;
// // preg_match_all('@src="([^"]+)"@', $text, $match);
// var_dump($text);
