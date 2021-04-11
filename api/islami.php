<?php
// var_dump($_GET);
// die();
require __DIR__ . '/middleware.php';
$modules = strtolower($_GET['module']);
$qwerry = strtolower($_GET['mod']);
$q = strtolower($_GET['query']);
if (isset($modules)) {
    if ($modules == 'bacaan_shalat') {
        if ($qwerry == 'al_fatihah') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/al fatihah.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'diantara_sujud') {
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
        } elseif ($qwerry == 'tasyahud_akhir' || $qwerry == 'tahiat_akhir') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/tasyahud akhir.json'));
            render_json(array(
                "data" => $a[0]
            ));
        } elseif ($qwerry == 'tasyahud_awal' || $qwerry == 'tahiat_awal') {
            $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/bacaanshalat/tasyahud awal.json'));
            render_json(array(
                "data" => $a[0]
            ));
        }
    } elseif ($modules == 'asmaulhusna') {
        // echo "test";
        // die();
        $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/data/dataAsmaulHusna.json'));
        render_json(array(
            "asmaulhusna" => $a->data
        ));
    } elseif ($modules == 'ayat_kursi') {
        // echo "test";
        // die();
        $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/data/dataAyatKursi.json'));
        render_json(array(
            "ayat_kursi" => $a->data
        ));
    } elseif ($modules == 'doa_harian') {
        // echo "test";
        // die();
        $a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/data/dataDoaHarian.json'));
        foreach ($a->data as $aa) {
            if (strtolower($aa->title) == strtolower($q)) {
                $ab[] = array(
                    "title" => $aa->title,
                    "arabic" => $aa->arabic,
                    "latin" => $aa->latin,
                    "translation" => $aa->translation
                );
            }
        }
        if (count($ab) == 0) {
            foreach ($a->data as $aa) {
                $abC[] = $aa->title;
                
            }
            render_json(array(
                "error" => true,
                "tersedia_doa" => implode(PHP_EOL, $abC)
            ));
            exit();
        }
        render_json(array(
            "doa" => $ab
        ));
    } elseif ($modules == 'kisah_nabi') {
        $a = file_get_contents(__DIR__ . '/../json_data/zhirss/kisahnabi/' . $q . '.json');
        if ($a == false) {
            render_json(array(
                "error" => "kisah tidak ditemukan"
            ));
        } else {
            $RES = json_decode($a);
            $R = array(
                "nama" => $RES->name,
                "cerita" => $RES->description,
            );
            render_json($R);
        }
    } elseif ($modules == 'niat_shalat') {
        $a = file_get_contents(__DIR__ . '/../json_data/zhirss/data/dataNiatShalat.json');
        $RES = json_decode($a);

        render_json($RES);
    }
}
