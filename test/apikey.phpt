<?php

require __DIR__ . '/../vendor/autoload.php';

use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

$youtube = new YouTubeDownloader();

try {
    $downloadOptions = $youtube->getDownloadLinks("http://www.youtube.com/watch?v=K4DyBUG242c");
    $A = json_encode($downloadOptions->getAllFormats(), JSON_PRETTY_PRINT);
    file_put_contents('tes.txt', $A);
    // if ($downloadOptions->getAllFormats()) {
    //     echo $downloadOptions->getFirstCombinedFormat()->url;
    // } else {
    //     echo 'No links found';
    // }
} catch (YouTubeException $e) {
    echo 'Something went wrong: ' . $e->getMessage();
}
