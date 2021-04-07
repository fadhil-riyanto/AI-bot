<?php
require __DIR__ . '/middleware.php';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://docs-api-zahirrr.herokuapp.com/api/meme");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    render_json(json_decode($output));

