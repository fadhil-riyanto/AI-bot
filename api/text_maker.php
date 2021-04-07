<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['theme'])) {
    if (strlen($_GET['theme']) < 1) {

        render_json(array(
            'error' => 'theme tidak boleh kosong'
        ));
    } else {
        require __DIR__ . '/photooxy_theme.php';
        $ngecek = themeddatas($_GET['theme']);
        if ($ngecek == false) {

            render_json(array(
                'error' => 'theme tidak ditemukan'
            ));
        } else {
            if (isset($_GET['kata1'])) {
                if (isset($_GET['kata2'])) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://textmakes.anonymoususer18.repl.co/index_text_maker.php?theme=" . $_GET['theme'] . "&kata1=" . $_GET['kata1'] . "&kata2=" . $_GET['kata2']);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    echo json_encode(json_decode($output), JSON_PRETTY_PRINT);
                    exit;
                }


                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://textmakes.anonymoususer18.repl.co/index_text_maker.php?theme=" . $_GET['theme'] . "&kata1=" . $_GET['kata1']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                echo json_encode(json_decode($output), JSON_PRETTY_PRINT);
            }
        }
    }
} else {

    render_json(array(
        'error' => 'theme ga ditemukan'
    ));
}
