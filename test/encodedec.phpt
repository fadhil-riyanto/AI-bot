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

echo decode('b3l5k4o4b3b465n4e3s4s2k4n3k4t3n3u4c4d393n453x3n555t433f3p3x2w3h3e3k3n5y3m484o5l474k545y5l4w3l5x5y2b493k4h3v5v4s4g3x2o483q3i314x4p5s4j4t42364z2n49353r4q4r4w2s4q4a4j4k4p4b3p3m4q4e3b493l454z4d3c3t3a41473a3g4z2p4');
