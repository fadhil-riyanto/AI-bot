<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['query']) && isset($_GET['method'])) {
    $method = strtolower($_GET['method']);
    

    render_json($m);
}
