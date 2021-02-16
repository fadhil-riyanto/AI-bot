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
if ($azanHilangcommand == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan phpdocs, gunakan command <pre>/php_docs {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
        'Contoh : <pre>/quotes kamu bagaikan bunga dipagi hari</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $html = file_get_html('https://www.php.net/' . $udahDiparse);

    foreach ($html->find('div[class=methodsynopsis dc-description]') as $elements) {
        if ($elements->plaintext == null) {
            echo "ga nemu";
            exit;
        }
    }
    foreach ($html->find('h1[class=refname]') as $elements)
        $phpdoc1 = "<b>" . $elements->plaintext . "</b>" . PHP_EOL;

    foreach ($html->find('p[class=verinfo]') as $elements)
        $phpdoc2 =  "<i>" . $elements->plaintext . "</i>" . PHP_EOL . PHP_EOL;

    foreach ($html->find('p[class=refpurpose]') as $elements)
        $phpdoc3 =  "<i>" . $elements->plaintext . "</i>" . PHP_EOL . PHP_EOL;

    foreach ($html->find('div[class=methodsynopsis dc-description]') as $elements)
        $phpdoc4 = '<b>parameters</b> : <pre>' . $elements->plaintext . "</pre>" . PHP_EOL . PHP_EOL;

    foreach ($html->find('p[class=para rdfs-comment]') as $elements)
        $phpdoc5 = '<b>Description : </b>' . $elements->plaintext;

    foreach ($html->find('div[class=caution]') as $elements)
        $phpdoc6 = $elements->plaintext;

    foreach ($html->find('div[class=refsect1 returnvalues]') as $elements)
        $phpdoc7 =   $elements->plaintext;

    if (isset($phpdoc6)) {
        $reply =  $phpdoc1 . $phpdoc2 . $phpdoc3 . $phpdoc4 . $phpdoc5 . $phpdoc6 . PHP_EOL . PHP_EOL . $phpdoc7;
        $content = array('chat_id' => $chat_id, 'text' => removeEscapedphpdocs($reply), 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply =  $phpdoc1 . $phpdoc2 . $phpdoc3 . $phpdoc4 . $phpdoc5 . PHP_EOL . PHP_EOL . $phpdoc7;
        $content = array('chat_id' => $chat_id, 'text' => removeEscapedphpdocs($reply), 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
