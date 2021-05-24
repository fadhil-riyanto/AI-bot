<?php
$a = <<<EOF
mysqli_connect("a","a","a","a");
echo parse("okok");
EOF;
try {

    $a = eval($a);
} catch (Throwable $t) {
    $a = "ngerror : " .  $t;
}

echo $a;
