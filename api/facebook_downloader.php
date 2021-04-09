<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['kualitas'])) {
    if (isset($_GET['url'])) {
        $cinfff = strtolower($_GET['kualitas']);
        if ($cinfff == strtolower('low')) {

            $url = $_GET['url'];
            require __DIR__ . '/fbdl_class.php';
            $res = json_decode(getlinkfbdl());
            render_json(array(
                "result" => $res->links->Download_Low_Quality
            ));
        } elseif ($cinfff == strtolower('high')) {

            $url = $_GET['url'];
            require __DIR__ . '/fbdl_class.php';
            $res = json_decode(getlinkfbdl());
            render_json(array(
                "result" => $res->links->Download_High_Quality
            ));
        }
    }
}
