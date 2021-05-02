<?php

function is_manusia($word)
{


    $word = hyphenizes($word);
    if (strlen($word) > 110) {
        return true;
    }
    //deteksi link
    $linkk = preg_match('/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3})([\s.,;\?\!]|$)/', $word);
    if ($linkk === true) {
        return true;
    }
    //deteksi command
    $a = substr($word, 0, 1);
    if ($a == '/' || $a == '.' || $a == '!' || $a == '{' || $a == '}' || $a == '[' || $a == ']') {
        return true;
    }
    $deteclink = preg_match("/(telega\.one|(tx|t)\.me|telegram\.(dog|me|space)|tele\.click)\/\w{5,}/", $word);
    if ($deteclink == true) {
        return true;
    }

    //languange programming
    $kata = array(
        //javascript
        "console.log", "tg.request", "message_id", "msg.message_id", "if (", "if(", "exec(msg.text)", "exec(msg.text",
        "console",

        //php
        "chat_id", "json_encode", "json_decode", "<?php", "print", "mysqli", "mysql",

        //kata kunci
        "asm", "auto", "bool", "break", "case",
        "catch", "char", "class", "const", "const_cast",
        "continue", "default", "delete", "do", "double",
        "dynamic_cast", "else", "enum", "explicit", "extern",
        "false", "float", "for", "goto",
        "if", "inline", "int", "long", "mutable",
        "namespace", "new", "operator", "private", "protected",
        "public", "register", "reinterpret_cast", "return", "short",
        "signed", "sizeof", "static", "static_cast", "struct",
        "switch", "template", "this", "throw", "true",
        "try", "typedef", "tyepeid", "typename", "union",
        "unsigned", "using", "virtual", "void", "volatile",
        "wchar_t", "Reguler", "Exppresot",

        //python
        "true", "def", "if", "raise",
        "false", "del", "import", "return",
        "none", "elif", "in", "try",
        "and", "else", "is", "while",
        "as", "except", "lambda", "with",
        "assert", "finally", "nonlocal", "yield",
        "break", "for", "not",
        "class", "from", "or",
        "continue", "global", "pass",
    );

    foreach ($kata as $kk) {
        if (strpos($word, $kk) !== false) {
            return true;
        }
    }
    return $word;
}
//var_dump(is_manusia(''));

function hyphenizes($string)
{
    $dict = array(
        'simi' => 'fadhil',
        'sim' => 'fadhil',
        'simsimi' => 'fadhil',
        'sasimi' => 'fadhil',
        'gila' => 'sehat',
        'knp' => 'kenapa',
        'bokep' => 'nonton drakor',
        'bokepan' => 'nonton drakor',
        'yg' => 'yang',
        '?' => null,
        '*' => null,
        '@' => null,
        '!' => null,
        '-' => null,
        'yoi' => 'iya'

        // replace teks lainnya disini
    );
    return strtolower(
        preg_replace(
            array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
            array(' ', ''),

            cleanStrings(
                str_replace(
                    array_keys($dict),
                    array_values($dict),
                    urldecode($string)
                )
            )
        )
    );
}
function cleanStrings($text)
{
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-',
        '/[’‘‹›‚]/u'    =>   ' ',
        '/[“”«»„]/u'    =>   ' ',
        '/ /'           =>   ' ',
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
