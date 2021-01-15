<?php
robot_artificial_intelegence('km dimana?');
function robot_artificial_intelegence($teks){
	
	$koneksi = @mysqli_connect('localhost', 
								'root', 
								'root', 
								'artificial_intelegence');
						
	$preg_0001 =  preg_replace('/km/', 'kamu', $teks);
	$preg_0002 =  preg_replace('/lg/', 'lagi', $preg_0001);
	$preg_0003 =  preg_replace('/knp/', 'kenapa', $preg_0002);
	$preg_hasil =  preg_replace('/tg/', 'telegram', $preg_0003);

	$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$preg_hasil' ");
	$tes_jumlah_row = @mysqli_affected_rows($koneksi);
	$dataAI = mysqli_fetch_assoc($q);
	
	if ($tes_jumlah_row > 0) {
		//var_dump($dataAI);
		echo $dataAI['data_res_ai'];
	}else{
		exit;
	}
	/*foreach ($q as $respon) {

		echo $respon['data_res_ai'] . PHP_EOL;
		
		//exit;
	}*/
}