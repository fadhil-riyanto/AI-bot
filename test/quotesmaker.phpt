<?php
require __DIR__ . "/../vendor/autoload.php";

use masokky\QuoteMaker;

$text = 'kamu aku bagaikan permaisuri di atas awan yang indah';
try {
    $text = wordwrap($text, 26);
    (new QuoteMaker)
        ->setBackground('ex.jpg')
        ->quoteText($text)
        ->setQuoteFontSize(60)
        ->toFile("result.jpg");
} catch (Exception $e) {
    echo $e->getMessage();
}
