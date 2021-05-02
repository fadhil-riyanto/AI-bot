<?php
function is_manusia($word)
{
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
        "wchar_t",

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
}
var_dump(is_manusia(''));
