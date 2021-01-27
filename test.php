<?php
$teks = "hasil 8+7 dong";
// INI INPUT

$g  = preg_match('/[a-zA-Z]\s+([-+]?\s*\d+(?:\s*[-+*\/]\s*[-+]?\s*\d+)+)/i', $teks, $hasil);
eval("\$h = $hasil[1];");
$jawab = array("hasil adalah " . $h, "hyy hasil nya itu " . $h, "eh hasil nya " . $h);

// INI OUTPUT
echo $jawab[random_int(1, 2)];
