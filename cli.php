<?php
$nama_pengirim_bot = 'Komputer     : ';
$nama_user         = 'Kamu         : ';


class Colors
{
	private $foreground_colors = [];
	private $background_colors = [];

	private static $foregroundColors = [
		'black'        => '0;30',
		'dark_gray'    => '1;30',
		'blue'         => '0;34',
		'light_blue'   => '1;34',
		'green'        => '0;32',
		'light_green'  => '1;32',
		'cyan'         => '0;36',
		'light_cyan'   => '1;36',
		'red'          => '0;31',
		'light_red'    => '1;31',
		'purple'       => '0;35',
		'light_purple' => '1;35',
		'brown'        => '0;33',
		'yellow'       => '1;33',
		'light_gray'   => '0;37',
		'white'        => '1;37',
	];
	private static $backgroundColors = [
		'black'      => '40',
		'red'        => '41',
		'green'      => '42',
		'yellow'     => '43',
		'blue'       => '44',
		'magenta'    => '45',
		'cyan'       => '46',
		'light_gray' => '47',
	];

	public function __construct()
	{
		// Set up hell warna.
		$this->foreground_colors['black'] = '0;30';
		$this->foreground_colors['dark_gray'] = '1;30';
		$this->foreground_colors['blue'] = '0;34';
		$this->foreground_colors['light_blue'] = '1;34';
		$this->foreground_colors['green'] = '0;32';
		$this->foreground_colors['light_green'] = '1;32';
		$this->foreground_colors['cyan'] = '0;36';
		$this->foreground_colors['light_cyan'] = '1;36';
		$this->foreground_colors['red'] = '0;31';
		$this->foreground_colors['light_red'] = '1;31';
		$this->foreground_colors['purple'] = '0;35';
		$this->foreground_colors['light_purple'] = '1;35';
		$this->foreground_colors['brown'] = '0;33';
		$this->foreground_colors['yellow'] = '1;33';
		$this->foreground_colors['light_gray'] = '0;37';
		$this->foreground_colors['white'] = '1;37';

		$this->background_colors['black'] = '40';
		$this->background_colors['red'] = '41';
		$this->background_colors['green'] = '42';
		$this->background_colors['yellow'] = '43';
		$this->background_colors['blue'] = '44';
		$this->background_colors['magenta'] = '45';
		$this->background_colors['cyan'] = '46';
		$this->background_colors['light_gray'] = '47';
	}

	// kembalikan warna
	public function getColoredString($string, $foreground_color = null, $background_color = null, $new_line = false)
	{
		$colored_string = '';

		// Check if given foreground color found
		if (isset($this->foreground_colors[$foreground_color])) {
			$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . 'm';
		}
		// Check if given background color found
		if (isset($this->background_colors[$background_color])) {
			$colored_string .= "\033[" . $this->background_colors[$background_color] . 'm';
		}

		// Add string and end coloring
		$colored_string .= $string . "\033[0m";

		return $new_line ? $colored_string . PHP_EOL : $colored_string;
	}

	public function getForegroundColors()
	{
		return array_keys($this->foreground_colors);
	}

	public function getBackgroundColors()
	{
		return array_keys($this->background_colors);
	}

	public static function initColoredString(
		$string,
		$foregroundColor = null,
		$backgroundColor = null
	) {
		$coloredString = '';

		if (isset(static::$foregroundColors[$foregroundColor])) {
			$coloredString .= "\033[" . static::$foregroundColors[$foregroundColor] . 'm';
		}
		if (isset(static::$backgroundColors[$backgroundColor])) {
			$coloredString .= "\033[" . static::$backgroundColors[$backgroundColor] . 'm';
		}

		$coloredString .= $string . "\033[0m";

		return $coloredString;
	}

	public static function notice($msg)
	{
		fwrite(STDOUT, self::initColoredString($msg, 'light_gray') . PHP_EOL);
	}

	public static function error($msg)
	{
		fwrite(STDERR, self::initColoredString($msg, 'red') . PHP_EOL);
	}

	public static function warn($msg)
	{
		fwrite(STDOUT, self::initColoredString($msg, 'yellow') . PHP_EOL);
	}
	public static function success($msg)
	{
		fwrite(STDOUT, self::initColoredString($msg, 'green') . PHP_EOL);
	}
}

$msg_colors = new Colors();
//SEtting
date_default_timezone_set('Asia/Jakarta');
// End set
echo $msg_colors->getColoredString(' _______________________________________________________________________', 'blue', 'null') . PHP_EOL;
echo $msg_colors->getColoredString('|                                                                       ', 'blue', 'null') . PHP_EOL;
echo $msg_colors->getColoredString('|    Hai fadhil', 'greem', 'null') . PHP_EOL;
echo $msg_colors->getColoredString('|    Saya BOT buatan Fadhil. saya dibuat untuk mengatasi kebosanan      ', 'yellow', 'null') . PHP_EOL;
echo $msg_colors->getColoredString('|                                                                       ', 'yellow', 'null') . PHP_EOL;
echo $msg_colors->getColoredString('|_______________________ Tulis /exit Untuk Stop ________________________', 'yellow', 'null') . PHP_EOL;
menu:
echo $nama_user;
$input_chat = fopen("php://stdin", "r");
$out = strtolower(trim(fgets($input_chat)));
$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');

//$koneksi = @mysqli_connect('localhost', 'root', 'root', 'ai_data');
$q = @mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '$out' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);
// AI dimuali
if (
	$out === 'info' || $out === 'tampilkan info' || $out === 'info saya' || $out === 'info bot ini'
	|| $out === 'informasi bot' || $out === 'infonya' || $out === 'tolong saya' || $out === '/info' || $out === 'tolong'
) {
	echo $nama_pengirim_bot . '/info untuk mengetahui info tentang asisten ini' . PHP_EOL;
	echo $nama_pengirim_bot . '/waktu untuk melihat info waktu sekarang' . PHP_EOL;
	echo $nama_pengirim_bot . '/hitung untuk membuka dan menghitung aritmetika sederhana' . PHP_EOL;
	echo $nama_pengirim_bot . '/delete untuk menghapus beberapa kosakata dari index' . PHP_EOL;
	echo $nama_pengirim_bot . '/algorithm untuk melihat daftar algoritma di artimetika sederhana, lihat poin tentang /hitung' . PHP_EOL;
	echo $nama_pengirim_bot . '/exit untuk keluar dari program ini' . PHP_EOL;
	goto menu;
} elseif ($out === 'ini jam berapa?' || $out === '/waktu' || $out === 'ini jam berapa ya?' || $out === 'jam sekarang!' || $out === 'lihat jam' || $out === 'waktu') {
	echo $nama_pengirim_bot . 'Sekarang waktu ' . date('h:i:s a') . ' di timezone jakarta/indonesia' . PHP_EOL;
	goto menu;
} elseif ($out === '/info') {
	echo $nama_pengirim_bot . 'Ini adalah BOT dengan kemampuan AI yang di program oleh Fadhil Riyanto' . PHP_EOL;
	echo $nama_pengirim_bot . 'Kenapa ini bot saya buat? Yaitu untuk menjadi asisten pribadi saya' . PHP_EOL;
	echo $nama_pengirim_bot . 'Dikarnakan saya tidak mempunyai teman chatting, makanya saya membuat bot saja' . PHP_EOL;
	echo $nama_pengirim_bot . 'Bot ini sudah dilengkapi dengan kosakata kosakata pintar agar bisa berbicara dengan manusia' . PHP_EOL;
	echo $nama_pengirim_bot . 'Dibuat di semarang dengan cinta, email saya id.fadhil.riyanto[at]gmail.com' . PHP_EOL;
	goto menu;
} elseif ($out === 'info corona' || $out === 'corona' || $out === 'infonya korona' || $out === 'info korona' || $out === 'korona indo' || $out === 'korona statistik') {
	$file_korona = @file_get_contents('https://api.kawalcorona.com/indonesia/');
	$file_korona_jsonParse = json_decode($file_korona, true);
	if ($file_korona_jsonParse != NULL) {
		foreach ($file_korona_jsonParse as $corona_jadi) {
			echo $nama_pengirim_bot . 'positif   ' . $corona_jadi['positif'] . PHP_EOL;
			echo $nama_pengirim_bot . 'sembuh    ' . $corona_jadi['sembuh'] . PHP_EOL;
			echo $nama_pengirim_bot . 'meninggal ' . $corona_jadi['meninggal'] . PHP_EOL;
			echo $nama_pengirim_bot . 'dirawat   ' . $corona_jadi['dirawat'] . PHP_EOL;
		}
		goto menu;
	} else {
		echo $nama_pengirim_bot . 'api error atau mungkin tidak ada internet' . PHP_EOL;
		goto menu;
	}
} elseif ($out === '/exit') {
	echo $nama_pengirim_bot . 'Bay Bay....' . PHP_EOL;
	echo $nama_pengirim_bot . 'Terimakasih udah gunain ini bot....hehe' . PHP_EOL;
	exit;
} elseif ($out == '/set') {
	echo $nama_pengirim_bot . 'masukkan url hook anda ';
	$curl_mentah = fopen("php://stdin", "r");
	$curl_matang = trim(fgets($curl_mentah));
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot1489990155:AAGb7YFsVA-G2Vs28R6fQQZ8uxMm3ouCFDg/setWebhook?url=" . $curl_matang);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	goto menu;
} elseif ($out === '/wiki' || $out === 'cari informasi' || $out === 'buka wikipedia' || $out === 'cari informasi' || $out === 'carikan' || $out === 'cari') {
	echo $nama_pengirim_bot . 'Hai, saya wiki. tugas saya mencari informasi' . PHP_EOL;
	echo $nama_pengirim_bot . 'Apa yang ingin di cari? ';
	$wiki_mentah = fopen("php://stdin", "r");
	$wiki_matang = trim(fgets($wiki_mentah));
	echo $nama_pengirim_bot . 'Oke, tunggu bentar' . PHP_EOL;
	sleep(2);
	$no_underskor = str_replace(' ', '_', $wiki_matang);
	//get data
	$wiki_get_datanya = file_get_contents('https://id.wikipedia.org/w/api.php?action=query&prop=extracts&format=xml&exintro=&titles=' . $no_underskor);
	$wiki_get_datanya_ubahKeXML = simplexml_load_string($wiki_get_datanya);
	$wiki_matang = $wiki_get_datanya_ubahKeXML->query->pages->page->extract;
	$wiki_escape = strip_tags($wiki_matang);
	$wiki_hitung = wordwrap($wiki_escape, 77);
	if ($wiki_escape != NULL) {
		echo $nama_pengirim_bot . PHP_EOL;
		echo '=================== HASIL ===============' . PHP_EOL;
		echo $wiki_hitung . PHP_EOL;
	} else {
		echo $nama_pengirim_bot . 'Maaf nih, Data tidak ditemukan' . PHP_EOL;
	}
	goto menu;
} elseif ($out === '/algorithm') {
	echo $nama_pengirim_bot . 'Ada beberapa algoritma, diantaranya' . PHP_EOL;
	echo $nama_pengirim_bot . 'tambah ( + ) digunakan untuk menambah suatu angka.   Key : ditambah' . PHP_EOL;
	echo $nama_pengirim_bot . 'kali   ( - ) digunakan untuk mengalikan suatu angka. Key : dikali' . PHP_EOL;
	echo $nama_pengirim_bot . 'kurang ( - ) digunakan untuk mengurangi suatu angka. Key : dikurangi' . PHP_EOL;
	echo $nama_pengirim_bot . 'bagi   ( / ) di gunakan untuk membagi angka          Key : dibagi' . PHP_EOL;
	echo $nama_pengirim_bot . 'modulo ( % ) di gunakan untuk mencari sisa bagi      Key : modulo' . PHP_EOL;
	goto menu;
} elseif ($out === '/hitung' || $out === 'hitungkan' || $out === 'buka kalkulator' || $out === 'calc' || $out === 'hitungin' || $out === 'hitung nomer' || $out === 'kalkulator') {
	echo $nama_pengirim_bot . 'Angka pertamannya? ';
	$tambah_calc_Num1 = fopen("php://stdin", "r");
	$tambah_calc_Num1_matang = trim(fgets($tambah_calc_Num1));

	echo $nama_pengirim_bot . 'Angka keduannya? ';
	$tambah_calc_Num2 = fopen("php://stdin", "r");
	$tambah_calc_Num2_matang = trim(fgets($tambah_calc_Num2));

	echo $nama_pengirim_bot . 'Mau diapakan? ';
	$parameters_cals = fopen("php://stdin", "r");
	$parameters_cals_matang = trim(fgets($parameters_cals));

	switch ($parameters_cals_matang) {
		case 'ditambah':
			$hasil_hitung = $tambah_calc_Num1_matang + $tambah_calc_Num2_matang;
			echo $nama_pengirim_bot . $hasil_hitung . PHP_EOL;
			break;
		case 'dikali':
			$hasil_hitung = $tambah_calc_Num1_matang * $tambah_calc_Num2_matang;
			echo $nama_pengirim_bot . $hasil_hitung . PHP_EOL;
			break;
		case 'dikurangi':
			$hasil_hitung = $tambah_calc_Num1_matang - $tambah_calc_Num2_matang;
			echo $nama_pengirim_bot . $hasil_hitung . PHP_EOL;
			break;
		case 'dibagi':
			$hasil_hitung = $tambah_calc_Num1_matang / $tambah_calc_Num2_matang;
			echo $nama_pengirim_bot . $hasil_hitung . PHP_EOL;
			break;
		case 'modulo':
			$hasil_hitung = $tambah_calc_Num1_matang % $tambah_calc_Num2_matang;
			echo $nama_pengirim_bot . $hasil_hitung . PHP_EOL;
			break;
		default:
			echo $nama_pengirim_bot . 'Maaf, algoritma tidak tersedia. silahkan ketik /algorithm untuk melihat daftarnya' . PHP_EOL;
	}
	goto menu;
} elseif ($out === '/delete') {
	echo 'BOT Anti Bugs: ';
	$insert_bugs = fopen("php://stdin", "r");
	$insert_bugs_matang = trim(fgets($insert_bugs));
	mysqli_query($koneksi, "DELETE FROM `data_ai` WHERE  `data_key_ai`='$insert_bugs_matang'");
	$rows_bugs = mysqli_affected_rows($koneksi);
	if ($rows_bugs > 0) {
		echo $nama_pengirim_bot . 'Data dihapus dari index' . PHP_EOL;
	} else {
		echo $nama_pengirim_bot . 'Data gagal di hapus. Data sudah tidak ada di database' . PHP_EOL;
	}
	goto menu;
} elseif ($tes_jumlah_row > 0) {
	foreach ($q as $respon) {
		echo $nama_pengirim_bot . $respon['data_res_ai'] . PHP_EOL;
	}
	goto menu;
} elseif ($tes_jumlah_row === 0) {
	// echo ''.PHP_EOL;
	// echo ' _______ Kata Tidak Ditemukan _______'.PHP_EOL;
	// echo 'BOT key      : ';
	// $insert = fopen("php://stdin","r");
	// $insert_matang = trim(fgets($insert));
	// if($insert_matang === '/batal'){
	// 	echo '++++ Input Dibatalkan ++++'.PHP_EOL;
	// 	goto menu;
	// }else{
	
		mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$out', 'null')");
	goto menu;
} else {
	echo $nama_pengirim_bot . 'tidak ada koneksi MySQL' . PHP_EOL;
	goto menu;
}
