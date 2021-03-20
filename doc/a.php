<?php
//ini inputan user (seolah olah aja, aslinya ntar diambil dari form html)
$input = "t.me
google.com
nasa.gov";

//pilihan, mau http atau https (ambil pakek html checkbox)
$pilihan = 'https';

//explode biar jadi array
$input_terexplode = explode(PHP_EOL, $input);

//lalu cek, di user pingin nya http ato https
if($pilihan == 'http'){
	//nah, ini diulang dulu daftar nya
	foreach($input_terexplode as $inputex){
		//lalu digabung, oh ya. di php kalau mau gabung string pakek nya titik
		//digabung pakek http
		$hasil[] = 'http://' . $inputex;
	}
	//nah, implode digunakan untuk menggabungkan hasil array yg udah jadi diatas sebagai PHP_EOL
	//INFO: php eol adalah cara agar bisa newline, kalau windows kan crlf, linux lf, mac os itu crack_check
	// nah kan ribet kalau suruh gonta gant itu kalau beda sistem
	// nah pakek php_eol aja yg praktis. jadi akan mengikuti sistem operasi nya
	$matang = implode(PHP_EOL, $hasil);
	//tampilkan
	echo $matang;
}elseif($pilihan == 'https'){
	//ini penjelasan sama kek diatas
	foreach($input_terexplode as $inputex){
		$hasil[] = 'https://' . $inputex;
	}
	$matang = implode(PHP_EOL, $hasil);
	
	echo $matang;
}