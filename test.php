<?php
$code = 'echo "oke"';
try {
    $result = eval($code);
} catch (ParseError $e) {
    echo 'error : ' . $e->getMessage();
}