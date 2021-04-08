<?php
require __DIR__ . '/middleware.php';
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
        render_json(array(
            'error' => 'internal sistem'
        ));
    }
} else {
    render_json(array(
        'error' => 'parameter tidak lengkap, dibutuhkan kata'
    ));
}
