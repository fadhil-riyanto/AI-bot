<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['query'])) {
    $br = $_GET['query'];
    $a = file_get_contents(__DIR__ . '/../json_data/zhirss/kisahnabi/' . $br . '.json');
    if ($a == false) {
        echo json_encode(array(
            "error" => "internal sistem"
        ));
    } else {
        $RES = json_decode($a);
        $R = array(
            "nama" => $RES->name,
            "cerita" => $RES->description,
        );
        render_json($R);
    }
} else {
    render_json(array(
        'error' => 'parameter tidak lengkap, dibutuhkan query'
    ));
}
