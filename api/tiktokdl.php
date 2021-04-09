<?php
require __DIR__ . '/middleware.php';

if (isset($_GET['url'])) {
    require __DIR__ . '/../include/simple_html_dom.php';
    try {
        //code...
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://s.id', [
            'form_params' => [
                'url' => $_GET['url']
            ]
        ]);
        $htmls =  $response->getBody();
        echo "test";
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
        render_json(array(
            "downloadlink" => $a_link_tiktok,
            "thumb" => $match_gambar[0],
            "caption" => $kapsen_hehe
        ), JSON_PRETTY_PRINT);
    } catch (\GuzzleHttp\Exception\ServerException $th) {
        //throw $th;
        render_json(array(
            "error" => "intenal sistem"
        ), JSON_PRETTY_PRINT);
    }
} else {
    render_json(array(
        "error" => "parameter url dibutuhkan"
    ), JSON_PRETTY_PRINT);
}
