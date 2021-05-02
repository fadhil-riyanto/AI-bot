<?php
for ($a = 1; $a < 100; $a++) {
    $nodes[] = "https://api.simsimi.net/v1/?text=kamu%20kenapa?&lang=id";
}
$node_count = count($nodes);

$curl_arr = array();
$master = curl_multi_init();

for ($i = 0; $i < $node_count; $i++) {
    $url = $nodes[$i];
    $curl_arr[$i] = curl_init($url);
    curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
    curl_multi_add_handle($master, $curl_arr[$i]);
}

do {
    curl_multi_exec($master, $running);
} while ($running > 0);

//echo "results: ";
for ($i = 0; $i < $node_count; $i++) {
    $file = "vcc.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);

    $results = json_decode(curl_multi_getcontent($curl_arr[$i]));
    $file = "vcc.json";
    $data[] = $results;
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
}
// echo 'done';
