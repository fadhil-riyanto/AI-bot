<?php
require __DIR__ . '/middleware.php';

use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

$youtube = new YouTubeDownloader();

try {
    $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=aqz-KE-bpKQ");

    if ($downloadOptions->getAllFormats()) {
        echo $downloadOptions->getFirstCombinedFormat()->url;
    } else {
        echo 'No links found';
    }
} catch (YouTubeException $e) {
    echo 'Something went wrong: ' . $e->getMessage();
}
