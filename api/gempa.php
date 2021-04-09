<?php
require __DIR__ . '/middleware.php';
$data_gempanya = @simplexml_load_file('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.xml');
render_json($data_gempanya);
