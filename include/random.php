<?php
function random_number_hash(){
	$int_awal = random_int(1, 9);
	$int_kedua = random_int(100, 1000);
	$int_ketiga = $int_awal * $int_kedua;
	$int_keempat = random_int(100, 19999);
	$int_kelima = $int_ketiga * $int_keempat;
	$int_keenam = $int_awal + $int_kelima;
	$hashes1 = hash('md2', $int_keenam);
	$hashes2 = hash('md2', $int_kelima);
	$hashes3 = hash('md2', $int_keempat);
	$whirlpool = hash('whirlpool', $hashes1 . $hashes2 . $hashes3);
	return substr($whirlpool, 1, 100) ;
}
echo random_number_hash();