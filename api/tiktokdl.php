<?php
require __DIR__ . '/middleware.php';

if (isset($_GET['url'])) {

    $br = $_GET['url'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https: //textmakes.anonymoususer18.repl.co/tiktok.php?url=" . urlencode($br));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    render_json(json_decode($output));
} else {
    render_json(array(
        "error" => "parameter url dibutuhkan"
    ), JSON_PRETTY_PRINT);
}
