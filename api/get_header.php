<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['host'])) {
    $a = get_headers($_GET['host']);
    render_json($a);
} else {
    echo render_json(array(
        "error" => "parameter host tidak ada"
    ));
}
