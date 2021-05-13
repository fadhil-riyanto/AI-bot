<?php
for ($a = 1; $a < 1000000; $a++) {
    $nodes[] = "http://127.0.0.1/dns";
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

    $results = curl_multi_getcontent($curl_arr[$i]);
    echo $results;
}
// echo 'done';
