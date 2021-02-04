<?php
$file = "quot.json";
	$anggota = file_get_contents($file);
	$data = json_decode($anggota, true);
	echo count($data);