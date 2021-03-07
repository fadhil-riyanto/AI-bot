<?php
require __DIR__ . '/simple_html_dom.php';

$storeddata = __DIR__ . '/../json_data/corona_scrapper_cache.txt';
$getfilestore = file_get_contents($storeddata);
$ex_coviddata = explode('#', $getfilestore);

$delay_cov = 1200;
$math1_covid = $ex_coviddata[0] + $delay_cov;
$math2_covid = $math1_covid - time();
if ($math2_covid > 0) {
    $kasus = $ex_coviddata[1];
    $mati = $ex_coviddata[2];
    $sembuh = $ex_coviddata[3];
} elseif ($math2_covid < 0) {
    $html = file_get_html('https://www.worldometers.info/coronavirus/country/indonesia/');

    foreach ($html->find('div[class=maincounter-number]') as $elements) {
        $corona_crawl[] = preg_replace('/\s+/', '', $elements->plaintext);
    }
    $writecachecov = time() + $delay_cov . '#' . $corona_crawl[0] . '#' . $corona_crawl[1] . '#' . $corona_crawl[2];
    file_put_contents($storeddata, $writecachecov);

    $kasus = $corona_crawl[0];
    $mati = $corona_crawl[1];
    $sembuh = $corona_crawl[2];
}