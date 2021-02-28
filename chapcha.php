<?php
require 'vendor/autoload.php';

use Gregwar\Captcha\CaptchaBuilder;

$builder = new CaptchaBuilder;
$builder->build($width = 300, $height = 80, $font = null);
echo "<img src=" . $builder->inline() . " />";
echo $builder->getPhrase();