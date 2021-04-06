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
                    $ngab = array(
                        'base' => 'https://photooxy.com/',
                        'theme' => $ngecek,
                        'text_1' => $_GET['kata1'],
                        'text_2' => $_GET['kata2']
                    );
                    $urlss = photo_oxy_class($ngab);
                    
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

    render_json(array(
        'error' => 'theme ga ditemukan'
    ));
}
