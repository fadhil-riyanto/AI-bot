<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['anime'])) {
    $br = $_GET['anime'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://textmakes.anonymoususer18.repl.co/kusonime.php?anime=" . urlencode($br));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    render_json(json_decode($output));
}
