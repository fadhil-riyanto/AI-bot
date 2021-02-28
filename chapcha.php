<?php
require 'vendor/autoload.php';

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

$phraseBuilder = new PhraseBuilder(4, '0123456789');


$builder = new CaptchaBuilder(null, $phraseBuilder);
$builder->build($width = 300, $height = 80, $font = null);
echo "<img src=" . $builder->inline() . " />";
echo $builder->getPhrase();