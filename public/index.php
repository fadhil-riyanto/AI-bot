<?php

require __DIR__ . '/../vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/user/{id}', function ($userId) {
    return 'User with id: ' . $userId;
});
