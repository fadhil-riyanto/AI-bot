<?php
require __DIR__ . '/middleware.php';

use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;

if ($_GET['url']) {

    $youtube = new YouTubeDownloader();

    try {
        $downloadOptions = $youtube->getDownloadLinks($_GET['url']);

        if ($downloadOptions->getAllFormats()) {
            render_json($downloadOptions->getAllFormats());
        } else {
            render_json(array(
                "error" => "link tidak ditemukan"
            ));
        }
    } catch (YouTubeException $e) {
        render_json(array(
            "error" => "system internal, lapor @fadhil_riyanto"
        ));
    }
} else {
    render_json(array(
        "error" => "parameter url dibutuhkan"
    ));
}
