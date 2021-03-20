<?php

require __DIR__ . '/../vendor/autoload.php';
        require __DIR__ . '/../include/simple_html_dom.php';
        $baseurldata = 'https://photooxy.com';
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', 'https://en.ephoto360.com/write-text-on-wet-glass-online-589.html', ['allow_redirects' => false]);
        $htmls = $res->getBody();
		//echo $htmls;
        // echo $htmls;

        $html = str_get_html($htmls);
        // echo $htmls;

        $html = new simple_html_dom();
        $html->load($htmls);
        $text = $html->find('div[class=thumbnail]', 0)->innertext;
        preg_match_all('@src="([^"]+)"@', $text, $match);
