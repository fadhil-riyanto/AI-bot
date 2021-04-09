<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['text'])) {
    $alay_tingkat_dewa = [
        'a' => '4',
        'b' => '6',
        'c' => '(',
        'd' => 'D',
        'e' => '3',
        'f' => '|=',
        'g' => '9',
        'h' => '|-|',
        'i' => '!',
        'j' => 'J',
        'k' => '|<',
        'l' => '|_',
        'm' => '|v|',
        'n' => '|\|',
        'o' => '0',
        'p' => 'P',
        'q' => 'Q',
        'r' => '|2',
        's' => '5',
        't' => '7',
        'u' => '|_|',
        'v' => 'V',
        'w' => 'vv',
        'x' => 'X',
        'y' => '\'/',
        'z' => '2'
    ];

    $alay_tingkat_1 = [
        'a' => '4',
        'b' => '8',
        'g' => '9',
        's' => '5',
        'k' => 'x',
        'z' => '2',
        'u' => 'oe',
        't' => '7',
    ];

    $text = 'kamu kenapa sih?';

    function alay_generator($text, $level_alay)
    {
        $text = strtolower($text);
        $split = str_split($text);
        $new_text = "";
        foreach ($split as $huruf) {
            if (preg_match("/[a-z]/", $huruf)) {
                $new_text .= (isset($level_alay[$huruf])) ? $level_alay[$huruf] : $huruf;
            } else {
                $new_text .= $huruf;
            }
        }
        return $new_text;
    }
    $alay = alay_generator($text, $alay_tingkat_1);
    render_json(array(
        "result" => $alay
    ));
}else{
    render_json(array(
        "error" => "arameter text tidak ditemukan"
    ));
}

// } else if ($_POST['level_alay'] == 2) {
//     $alay = alay_generator($text, $alay_tingkat_dewa);
// }
