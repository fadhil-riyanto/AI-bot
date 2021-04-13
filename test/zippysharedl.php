<?php 
// https://www39.zippyshare.com/v/uFZX9dwG/file.html
require __DIR__ . '/../include/simple_html_dom.php';
require __DIR__ . '/../vendor/autoload.php';

    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', 'https://www39.zippyshare.com/v/uFZX9dwG/file.html');
    $htmls =  $response->getBody();
    // echo $htmls;

    $html = new simple_html_dom();
    $html->load($htmls);
    $text_buttonlink = $html->find('a[id=dlbutton]', 0);
    echo $text_buttonlink;