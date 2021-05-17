<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../include/simple_html_dom.php';
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://duckduckgo.com/?q=kucing&atb=v269-1&iar=images&iax=images&ia=images');
$htmls = $response->getBody();
echo $htmls;
die();

// // $html = str_get_html($htmls);
// echo $htmls;
// $html = new simple_html_dom();
// $html->load($htmls);
// $text = $html->find('span[class=tile--img__media__i]', 0)->innertext;
// var_dump($text);
// die();
// preg_match_all('@src="([^"]+)"@', $text, $match);
// var_dump($match);

// $html = str_get_html($htmls);
// foreach ($html->find('img') as $element)
//     echo $element->src . '<br>';

preg_match_all('/<img[^>]+>/i', $htmls, $result);
var_dump($result);
