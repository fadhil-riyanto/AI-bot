<?php
require __DIR__ . '/middleware.php';

if (isset($_GET['theme'])) {
    if (isset($_GET['kata1'])) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://textmakes.anonymoususer18.repl.co/index_text_maker.php?theme=" . $_GET['theme'] . "&kata1=" . $_GET['kata1']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $a = json_decode($output);
        render_json(array(
            'error' => $a->data->error,
            'image' => $a->data->image
        ));
        exit;
    }
} else {
    render_json(array(
        'error' => 'theme ga ditemukan'
    ));
}
