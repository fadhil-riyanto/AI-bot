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
$query_hasil = mysqli_fetch_assoc($q);
// AI dimuali
//var_dump($query_hasil);


if ($tes_jumlah_row > 0) {
		echo $nama_pengirim_bot . $query_hasil['data_res_ai'] . PHP_EOL;
	goto menu;
} elseif ($tes_jumlah_row === 0) {
		mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$out', 'null')");
	goto menu;
} else {
	echo $nama_pengirim_bot . 'tidak ada koneksi MySQL' . PHP_EOL;
	goto menu;
}
