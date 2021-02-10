<?php

	require 'vendor/autoload.php';
	
$nmap = new Nmap();

$nmap->scan([ 'williamdurand.fr' ], [ 21, 22, 80 ]);