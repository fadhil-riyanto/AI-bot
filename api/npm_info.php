<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['query'])) {
    $br = $_GET['query'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://registry.npmjs.org/" . urlencode($br));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    render_json(json_decode($output));
}
