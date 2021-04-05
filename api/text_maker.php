<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['theme'])) {
    if (strlen($_GET['theme']) < 1) {

        echo json_encode(array(
            'error' => 'theme tidak boleh kosong'
        ), JSON_PRETTY_PRINT);
    } else {
        require __DIR__ . '/photooxy_theme.php';
        $ngecek = themeddatas($_GET['theme']);
        if ($ngecek == false) {

            echo json_encode(array(
                'error' => 'theme tidak ditemukan'
            ), JSON_PRETTY_PRINT);
        } else {
            if (isset($_GET['kata1'])) {
                if (isset($_GET['kata2'])) {
                    $ngab = array(
                        'base' => 'https://photooxy.com/',
                        'theme' => $ngecek,
                        'text_1' => $_GET['kata1'],
                        'text_2' => $_GET['kata2']
                    );
                    $urlss = photo_oxy_class($ngab);
                    exit;
                }


                $ngab = array(
                    'base' => 'https://photooxy.com/',
                    'theme' => $ngecek,
                    'text_1' => $_GET['kata1']
                );
                $urlss = photo_oxy_class($ngab);
            }
        }
    }
} else {

    echo json_encode(array(
        'error' => 'theme ga ditemukan'
    ), JSON_PRETTY_PRINT);
}
