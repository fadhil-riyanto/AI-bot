<?php
require __DIR__ . '/../vendor/autoload.php';
$client = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => 'redis-17475.c238.us-central1-2.gce.cloud.redislabs.com',
    'port'   => 17475,
    // 'parameters' => [
    //     'password' => 'jUvAwYlZkipXrCvWmTfssFDoyDMjppFh',
    //     'database' => 'redistg',
    // ],
]);
$client->set('foo', 'bar');
