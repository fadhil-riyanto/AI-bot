<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../include/simple_html_dom.php';
$client = new \GuzzleHttp\Client();
$response = $client->request('POST', 'https://snaptik.app/action-2021.php?lang=EN', [
    'form_params' => [
        'url' => 'https://vt.tiktok.com/ZSJ6kwYac/'
    ]
]);
$htmls =  $response->getBody();
//dapatkan button link
$html = new simple_html_dom();
$html->load($htmls);
$text_buttonlink = $html->find('div[class=abuttons]', 0)->innertext;
//get value href
preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $text_buttonlink, $matc_link_button);
$a_link_tiktok = $matc_link_button['href'];


$html = new simple_html_dom();
$html->load($htmls);
$text_img = $html->find('div[class=zhay-left left]', 0)->innertext;
//preg_match_all('@src="([^"]+)"@', $text, $match_image);

//ekstrak linh
preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text_img, $match_gambar);


$captionnn = $html->find('div[class=zhay-middle center]', 0)->innertext;
$kapsen_hehe = strip_tags($captionnn);
echo json_encode(array(
    "downloadlink" => $a_link_tiktok,
    "thumb" => $match_gambar[0],
    "caption" => $kapsen_hehe
), JSON_PRETTY_PRINT);
die();
