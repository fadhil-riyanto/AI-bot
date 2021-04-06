<?php
require __DIR__ . '/middleware.php';


function animecheck($string)
{
    $string = strtolower($string);
    $dict = array(
        'waifu' => 'waifu',
        'neko' => 'neko',
        'shinobu' => 'shinobu',
        'megumin' => 'megumin',
        'bully' => 'bully',
        'cuddle' => 'cuddle',
        'cry' => 'cry',
        'hug' => 'hug',
        'awoo' => 'awoo',
        'kiss' => 'kiss',
        'lick' => 'lick',
        'pat' => 'pat',
        'smug' => 'smug',
        'bonk' => 'bonk',
        'yeet' => 'yeet',
        'blush' => 'blush',
        'smile' => 'smile',
        'wave' => 'wave',
        'smile' => 'smile',
        'wave' => 'wave',
        'highfive' => 'highfive',
        'handhold' => 'handhold',
        'nom' => 'nom',
        'bite' => 'bite',
        'glomp' => 'glomp',
        'kill' => 'kill',
        'slap' => 'slap',
        'happy' => 'happy',
        'wink' => 'wink',
        'poke' => 'poke',
        'dance' => 'dance',
        'cringe' => 'cringe',
        'blush' => 'blush'
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}

function animecheck_nsfw($string)
{
    $string = strtolower($string);
    $dict = array(
        'waifu' => 'waifu',
        'neko' => 'neko',
        'trap' => 'trap',
        'blowjob' => 'blowjob',
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}

if (isset($_GET['type'])) {
    $tipe = $_GET['type'];
    if ($tipe == 'sfw') {
        if (isset($_GET['kategori'])) {
            $category = $_GET['kategori'];
            $check = animecheck($category);
            if ($check == false) {
                $arr = array(
                    "error" => "kategori tidak ditemukan"
                );
                render_json($arr);
            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://waifu.pics/api/sfw/" . $check);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                $hasil = json_decode($output);
                // render_json($hasil);
                $typed = image_type_to_mime_type(exif_imagetype($hasil->url));
                header('Content-type: ' . $typed);
                echo readfile($hasil->url);
            }
        }
    } elseif ($tipe == 'nsfw') {
        if (isset($_GET['kategori'])) {
            $category = $_GET['kategori'];
            $check = animecheck_nsfw($category);
            if ($check == false) {
                $arr = array(
                    "error" => "kategori tidak ditemukan"
                );
                render_json($arr);
            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://waifu.pics/api/nsfw/" . $check);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                $hasil = json_decode($output);
                // render_json($hasil);
                $typed = image_type_to_mime_type(exif_imagetype($hasil->url));
                header('Content-type: ' . $typed);
                echo readfile($hasil->url);
            }
        }
    } else {
        $arr = array(
            "error" => "type yang diperbolehkan hanya sfw dan nsfw"
        );
        render_json($arr);
    }
}
