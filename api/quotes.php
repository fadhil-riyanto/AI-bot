<?php
require __DIR__ . '/../vendor/autoload.php';

use masokky\QuoteMaker;

if (isset($_GET['kata'])) {
    $text =  wordwrap($_GET['kata'], 20, "\n");
    try {
        (new QuoteMaker)
            ->setBackground(__DIR__ . '/../assets/quotesgen/img' . random_int(1, 30) . '.jpg')
            ->quoteText($text)
            ->setWatermarkFontSize(34)
            ->setQuoteFontSize(60)
            ->toScreen();
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(array(
            'error' => 'internal sistem'
        ), JSON_PRETTY_PRINT);
    }
}
