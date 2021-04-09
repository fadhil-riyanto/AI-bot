<?php
// var_dump($_GET);
// die();
require __DIR__ . '/middleware.php';
$modules = strtolower($_GET['module']);
$qwerry = strtolower($_GET['query']);
if (isset($modules)) {
    if ($modules == 'baacaan_shalat') {
        if ($qwerry == 'al fatiha') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/al fatihah.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'diantara sujud') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/diantara dua sujud.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'iftitah') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/iftitah.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'ruku') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/ruku.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'salam') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/salam.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'sujud') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/sujud.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'tasyahud akhir' || $qwerry == 'tahiat akhir') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/tasyahud akhir.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'tasyahud awal' || $qwerry == 'tahiat awal') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/tasyahud awal.json'));
            render_json(array(
                "data" => $a[0]
            ));
        }
    }
}
