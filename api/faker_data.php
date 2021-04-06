<?php
require __DIR__ . '/middleware.php';
$faker = Faker\Factory::create();

$arr = array(
    "name" => $faker->name,
    
);
render_json($arr);
