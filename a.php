<?php
$adanKota ='semarang';
	$tanggal = date("Y-m-d");
	$adanCurl = File_get_contents('https://api.pray.zone/v2/times/day.json?city='.$adanKota.'&date='.$tanggal);
	$json_array = json_decode($adanCurl, true);
	echo ( $json_array['results']['datetime'][0]['times']['Sunrise']);