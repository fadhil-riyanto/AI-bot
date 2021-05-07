<?php

use ParagonIE\Corner\Error;

try {
    $a = "['ok', 'sip']";
    echo implode(" ||", $a);
} catch (Exception $error) {
    echo "Error: {$error->getMessage()}";
}
