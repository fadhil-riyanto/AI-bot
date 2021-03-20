<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../include/simple_html_dom.php';
$baseurldata = 'https://photooxy.com';
$client = new GuzzleHttp\Client();
$res = $client->request('GET', 'https://brainly.co.id/app/ask?q=apa+itu+air', ['allow_redirects' => false]);
$htmls = $res->getBody();
//echo $htmls;
echo $htmls;

// $html = str_get_html($htmls);
// // echo $htmls;

// $html = new simple_html_dom();
// $html->load($htmls);
// $text = $html->find('form[class=ajax-submit]', 0)->innertext;
// preg_match_all('@value="([^"]+)"@', $text, $match);
//var_dump($match);

// $client = new GuzzleHttp\Client();
// $text = 'ngetes';
// $submit = $match[1][0];
// $token = $match[1][1];
// $hidden_buildserver = $match[1][2];
// $res = $client->request('POST', 'https://en.ephoto360.com/write-text-on-wet-glass-online-589.html?
// 							text[]=' . $text .
//     '&submit=' . $submit .
//     '&token=' . $token .
//     '&build_server=' . $hidden_buildserver, ['allow_redirects' => false]);
// $htmls = $res->getBody();

// // echo $htmls;
// // echo $text . $submit . $token . $hidden_buildserver;

// $html = str_get_html($htmls);
// // echo $htmls;

// $html = new simple_html_dom();
// $html->load($htmls);
// $text = $html->find('div[class=col-xs-9]', 0)->innertext;
// preg_match_all('@src="([^"]+)"@', $text, $match);
// print($htmls);
