<?php

function langsprogramming($string)
{
    $string = strtolower($string);
    $dict = array(
        '/assembly' => 'https://glot.io/api/run/assembly:::asm',
        '/ats' => 'https://glot.io/api/run/ats:::ats',
        '/bash' => 'https://glot.io/api/run/bash:::sh',
        '/c' => 'https://glot.io/api/run/c:::c',
        '/clojure' => 'https://glot.io/api/run/clojure:::clj',
        '/cobol' => 'https://glot.io/api/run/cobol:::cbl',
        '/coffeescript' => 'https://glot.io/api/run/coffeescript:::coffee',
        '/cpp' => 'https://glot.io/api/run/cpp:::cpp',
        '/crystal' => 'https://glot.io/api/run/crystal:::cr',
        '/csharp' => 'https://glot.io/api/run/csharp:::cs',
        '/d' => 'https://glot.io/api/run/d:::d',
        '/elixir' => 'https://glot.io/api/run/elixir:::ex',
        '/elm' => 'https://glot.io/api/run/elm:::elm',
        '/erlang' => 'https://glot.io/api/run/erlang:::erl',
        '/fsharp' => 'https://glot.io/api/run/fsharp:::fs',
        '/go' => 'https://glot.io/api/run/go:::go',
        '/groovy' => 'https://glot.io/api/run/groovy:::groovy',
        '/haskell' => 'https://glot.io/api/run/haskell:::hs',
        '/idris' => 'https://glot.io/api/run/idris:::idr',
        '/java' => 'https://glot.io/api/run/java:::java',
        '/javascript' => 'https://glot.io/api/run/javascript:::js',
        '/julia' => 'https://glot.io/api/run/julia:::jl',
        '/kotlin' => 'https://glot.io/api/run/kotlin:::kt',
        '/lua' => 'https://glot.io/api/run/lua:::lua',
        '/mercury' => 'https://glot.io/api/run/mercury:::m',
        '/nim' => 'https://glot.io/api/run/nim:::nim',
        '/nix' => 'https://glot.io/api/run/nix:::nix',
        '/ocaml' => 'https://glot.io/api/run/ocaml:::ml',
        '/perl' => 'https://glot.io/api/run/perl:::pl',
        '/php' => 'https://glot.io/api/run/php:::php',
        '/python' => 'https://glot.io/api/run/python:::py',
        '/raku' => 'https://glot.io/api/run/raku:::raku',
        '/ruby' => 'https://glot.io/api/run/ruby:::rb',
        '/rust' => 'https://glot.io/api/run/rust:::rs',
        '/scala' => 'https://glot.io/api/run/scala:::scala',
        '/swift' => 'https://glot.io/api/run/swift:::swift',
        '/typescript' => 'https://glot.io/api/run/typescript:::ts'
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}


$ngecekanime = langsprogramming($adanParse_plain_nokarakter[0]);
if ($ngecekanime == false) {
    $exuser = explode('@', strtolower($adanParse_plain_nokarakter[0]));
    $konf = langsprogramming($exuser[0]);
    if ($konf == false) {
        $animecek = false;
    } else {
        $animecek = true;
        $animeget = $konf;
    }
} else {
    $animecek = true;
    $animeget = $ngecekanime;
}

if ($animecek == true) {
    $azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
    if ($azanHilangcommand == null) {
        $reply = "ups, anda harus memasukkan kode yang ingin dieksekusi.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $prog = explode(':::', $animeget);
        $url = $prog[0] . '/latest';
        $content = array(
            'files' => [
                [
                    'name' => 'index.' . $prog[1],
                    'content' => $udahDiparse
                ]
            ]
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array("Content-type: application/json", "Authorization: Token " . GLOT_IO)
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($content));

        $json_response = curl_exec($curl);
        $responglo = json_decode($json_response);
        $outputs = str_replace('/home/glot/', '/usr/fadhil_project/', $responglo->stdout);
        $reply = 'output : ' . htmlspecialchars($outputs) . PHP_EOL .
            str_replace('/home/glot/', '/usr/fadhil_project/', $responglo->error) . PHP_EOL .
            str_replace('/home/glot/', '/usr/fadhil_project/', $responglo->stderr);
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;

        // $reply = "debug." . PHP_EOL .
        //     'URL > ' . $url . PHP_EOL .
        //     'kode > ' . $udahDiparse;
        // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        // $telegram->sendMessage($content);
    }
} else {
}
