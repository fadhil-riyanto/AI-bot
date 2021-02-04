<?php
for ($a = 1; $a < 200000; $a++) {
	$quot = @file_get_contents('http://lolhuman.herokuapp.com/api/random/quotes');
	$quu = json_decode($quot);
	if (@$quu->result->by != null) {
		$file = "quot.json";
		$anggota = file_get_contents($file);
		$data = json_decode($anggota, true);
		$data[] = array(
			'by'     => $quu->result->by,
			'quotes'   => $quu->result->quote
		);
		$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
		$anggota = file_put_contents($file, $jsonfile);

		echo 'diambil : ' . $a . PHP_EOL;
	} elseif (@$quu->result->by == null) {
		echo 'diambil : ' . $a . ' (Diabaikan karna kosong)' .  PHP_EOL;
	}
}
