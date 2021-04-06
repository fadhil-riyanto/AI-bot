<?php

function primbon_arti_nama($nama)
{
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../include/simple_html_dom.php';
    $baseurldata = 'https://photooxy.com';
    $client = new GuzzleHttp\Client(['base_uri' => 'https://www.primbon.com/']);
    $res = $client->request('GET', 'arti_nama.php?nama1=' . $nama . '&proses=+Submit%21+', ['allow_redirects' => false]);
    $htmls = $res->getBody();

    $html = new simple_html_dom();
    $html->load($htmls);
    $text = $html->find('div[id=body]', 0)->innertext;
    $a =  explode('<br>', $text);
    $arr = array(
        "keterangan_pendek" => strip_tags($a[2]),
        "keterangan_panjang" => strip_tags($a[4]),

    );
    return $arr;
}

var_dump(primbon_arti_nama('fadhil riyanto'));
