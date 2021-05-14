<?php
function encode($value)
{
    if (!$value) {
        return false;
    }

    $key = sha1('EnCRypT10nK#Y!RiSRNn');
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $crypttext = '';

    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($value, $i, 1));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $crypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }

    return $crypttext;
}


function decode($value)
{
    if (!$value) {
        return false;
    }

    $key = sha1('EnCRypT10nK#Y!RiSRNn');
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $decrypttext = '';

    for ($i = 0; $i < $strLen; $i += 2) {
        $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $decrypttext .= chr($ordStr - $ordKey);
    }

    return $decrypttext;
}

$masuk = encode(base64_encode(file_get_contents('qrcode.png')));
$Kluar = base64_decode(decode($masuk));
file_put_contents('outputs.png', $Kluar);
