<?php
require __DIR__ . "/../include/simple_html_dom.php";
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);

$watermarktext = $namaPertama . ' ' . $namaTerakhir;

function removeEscapedphpdocs($string)
{
    $dict = array(
        '&mdash;' => '-',
        'Return Values' => '<b>Return Values</b>'

        // replace teks lainnya disini
    );
    return str_replace(
        array_keys($dict),
        array_values($dict),
        $string
    );
}
function removespasikelebihan($str)
{
    $ro = preg_replace('/\s+/', ' ', $str);
    return $ro;
}
if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan phpdocs, gunakan command <pre>/php_docs {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
        'Contoh : <pre>/quotes kamu bagaikan bunga dipagi hari</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $funcname = $udahDiparse;
    $html = file_get_html('https://www.php.net/' . $funcname);

    foreach ($html->find('div[class=methodsynopsis dc-description]') as $elements)
        $parameterswkwk = '<b>parameters</b>' . PHP_EOL . '<pre>' . removespasikelebihan($elements->plaintext) . "</pre>";

    $phpdocfiles = file_get_contents(__DIR__ . "/../json_data/phpdocs/database.json");
    $phpdoc = json_decode($phpdocfiles);

    $hasil = '<b>' . $phpdoc->$funcname->name . '</b>' . PHP_EOL .
        '<i>' . $phpdoc->$funcname->ver . '</i>' . PHP_EOL . PHP_EOL .
        '<pre>' . $phpdoc->$funcname->name . '</pre> - ' . $phpdoc->$funcname->desc . PHP_EOL . PHP_EOL .
        $parameterswkwk  . PHP_EOL . PHP_EOL .
        '<b>Description</b>' . PHP_EOL . $phpdoc->$funcname->long_desc . PHP_EOL . PHP_EOL .
        '<b>Return value</b>' . PHP_EOL . $phpdoc->$funcname->ret_desc;

    $option = array(
        array($telegram->buildInlineKeyBoardButton("Ducumentation", $url = "https://www.php.net/manual/en/" . $phpdoc->$funcname->url))
    );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $reply = removeEscapedphpdocs($hasil);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
