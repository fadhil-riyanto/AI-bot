<?php
class filter_pesan
{
	public function kata_kata_jorok($text)
	{
		$daftar = array(
			'bokong', 'ass', 'Anjing', 'Babi', 'Monyet', 'Kunyuk', 'Bajingan', 'Asu', 'Bangsat', 'Kampret',
			'Kontol', 'Memek', 'Ngentot', 'Ngewe', 'Jembod', 'Jembud', 'Perek', 'Pecun', 'Bencong', 'Banci',
			'Jablay', 'Maho', 'Bego', 'Goblok', 'Idiot', 'Geblek', 'Orang Gila', 'Gila', 'Sinting', 'Tolol', 'Sarap',
			'Udik', 'Kampungan', 'Kamseupay', 'Buta', 'Budek', 'Bolot', 'Jelek', 'Setan', 'Iblis', 'Jahannam',
			'Dajjal', 'Jin Tomang', 'Keparat', 'Bejad', 'Gembel', 'Brengsek', 'Tai', 'Sompret',
		);
		foreach ($daftar as $filters) {
			if (stristr($text, $filters)) {
				return true;
			}
		}
		return false;
	}
	public function hyphenize($string)
	{
		$dict = array(
			"km"      => "kamu",
			"yoi"      => "ya",
			"yg"      => "yang",
			"gk"      => "tidak",
			"gak"      => "tidak",
			"kaga"      => "tidak",
			"ogah"      => "tidak",
			"males"      => "malas",
			"mager"      => "malas gerak",
			"&" => "dan",
			"+" => "tambah",
			"/" => "atau",
			"=" => "sama dengan",
			"ababil" => "anak ingusan",
			"abal2" => "palsu",
			"abal" => "palsu",
			"ad" => "ada",
			"akooh" => "aku",
			"alay" => "norak",
			"albm" => "album",
			"ampe" => "sampai",
			"anjir" => "waw",
			"aq" => "aku",
			"ato" => "atau",
			"atw" => "atau",
			"lg" => "lagi",
			"nie" => "nih",
			"baper" => "bawa perasaan",
			"bapuk" => "rusak",
			"bcra" => "bicara",
			"bebeb" => "pacar",
			"begin" => "awal",
			"bejibun" => "bertumpuk banyak",
			"bener" => "benar",
			"ber2" => "berdua",
			"ber3" => "bertiga",
			"better" => "lebih baik",
			"bf" => "pacar",
			"bgt" => "banget",
			"bhas" => "bahas",
			"bhg" => "bahagia",
			"bikin" => "buat",
			"binggo" => "banget",
			"bingit" => "banget",
			"bklan" => "bakalan",
			"bkn" => "bukan",
			"blg" => "bilang",
			"bnr" => "benar",
			"bnyk" => "banyak",
			"br" => "baru",
			"ya" => "iya",
			"yo" => "iya",
			"yoi" => "iya",
			"ok" => "oke",
			"okeh" => "oke",
			"okheh" => "oke",
			"asiap" => "siap",
			"asiapp" => "siap",
			"asiappp" => "siap",
			"asiapppp" => "siap",
			"bosku" => "bos",
			"bosqu" => "bos",
			"bosque" => "bos",
			"bg" => "bang",
			"mn" => "mana",
			"tg"    => "telegram"
			// replace teks lainnya disini
		);
		return strtolower(
			preg_replace(
				array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
				array(' ', ''),

				$this->cleanString(
					str_replace(
						array_keys($dict),
						array_values($dict),
						urldecode($string)
					)
				)
			)
		);
	}
	public function cleanString($text)
	{
		$utf8 = array(
			'/[áàâãªä]/u'   =>   'a',
			'/[ÁÀÂÃÄ]/u'    =>   'A',
			'/[ÍÌÎÏ]/u'     =>   'I',
			'/[íìîï]/u'     =>   'i',
			'/[éèêë]/u'     =>   'e',
			'/[ÉÈÊË]/u'     =>   'E',
			'/[óòôõºö]/u'   =>   'o',
			'/[ÓÒÔÕÖ]/u'    =>   'O',
			'/[úùûü]/u'     =>   'u',
			'/[ÚÙÛÜ]/u'     =>   'U',
			'/ç/'           =>   'c',
			'/Ç/'           =>   'C',
			'/ñ/'           =>   'n',
			'/Ñ/'           =>   'N',
			'/–/'           =>   '-',
			'/[’‘‹›‚]/u'    =>   ' ',
			'/[“”«»„]/u'    =>   ' ',
			'/ /'           =>   ' ',
		);
		return preg_replace(array_keys($utf8), array_values($utf8), $text);
	}
}


class Emoji
{
	/**
	 * Encode emoji in text
	 * @param string $text text to encode
	 */
	public static function Encode($text)
	{
		return self::convertEmoji($text, "ENCODE");
	}

	/**
	 * Decode emoji in text
	 * @param string $text text to decode
	 */
	public static function Decode($text)
	{
		return self::convertEmoji($text, "DECODE");
	}

	private static function convertEmoji($text, $op)
	{
		if ($op == "ENCODE") {
			return preg_replace_callback('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{1F000}-\x{1FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{1F000}-\x{1FEFF}]?/u', array('self', "encodeEmoji"), $text);
		} else {
			return preg_replace_callback('/(\\\u[0-9a-f]{4})+/', array('self', "decodeEmoji"), $text);
		}
	}

	private static function encodeEmoji($match)
	{
		return str_replace(array('[', ']', '"'), '', json_encode($match));
	}

	private static function decodeEmoji($text)
	{
		if (!$text) return '';
		$text = $text[0];
		$decode = json_decode($text, true);
		if ($decode) return $decode;
		$text = '["' . $text . '"]';
		$decode = json_decode($text);
		if (count($decode) == 1) {
			return $decode[0];
		}
		return $text;
	}
}

$a = new filter_pesan();
// $b =  $a->hyphenize('halo😄');
// print_r($b);
// $text = '😄,hi';
// $as =  Emoji::Encode($text);
// echo $a->hyphenize($as);




// $text = '\ud83d\ude04,hi';
// echo Emoji::Decode($text);

// $teks =  'km bebeb ;km mn?😄';
// $a1 = Emoji::Encode($teks);
// $a2 = dict($a1);
// echo $a2 . PHP_EOL . '==========' . Emoji::Decode($a2);
// function Uptime()
// {
// 	$ut = strtok(exec("cat /proc/uptime"), ".");
// 	$days = sprintf("%2d", ($ut / (3600 * 24)));
// 	$hours = sprintf("%2d", (($ut % (3600 * 24)) / 3600));
// 	$min = sprintf("%2d", ($ut % (3600 * 24) % 3600) / 60);
// 	$sec = sprintf("%2d", ($ut % (3600 * 24) % 3600) % 60);


// 	return array($days, $hours, $min, $sec);
// }
// $ut = Uptime();
// echo "Uptime: $ut[0]:$ut[1]:$ut[2]:$ut[3]";
function removeEmoji($text)
{
	$cleanText = "";

	// Match Emoticons
	$regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
	$cleanText = preg_replace($regexEmoticons, '', $text);

	// Match Miscellaneous Symbols and Pictographs
	$regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
	$cleanText = preg_replace($regexSymbols, '', $cleanText);

	// Match Transport And Map Symbols
	$regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
	$cleanText = preg_replace($regexTransport, '', $cleanText);

	return $cleanText;
}
// echo removeEmoji('😄haha');

function is_valid_domain($url)
{

	$validation = FALSE;
	/*Parse URL*/
	$urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
	/*Check host exist else path assign to host*/
	if (!isset($urlparts['host'])) {
		$urlparts['host'] = $urlparts['path'];
	}

	if ($urlparts['host'] != '') {
		/*Add scheme if not found*/
		if (!isset($urlparts['scheme'])) {
			$urlparts['scheme'] = 'http';
		}
		/*Validation*/
		if (checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'], array('http', 'https')) && ip2long($urlparts['host']) === FALSE) {
			$urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
			$url = $urlparts['scheme'] . '://' . $urlparts['host'] . "/";

			if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
				$validation = TRUE;
			}
		}
	}

	if (!$validation) {
		return false;
	} else {
		return true;
	}
}

// //Function Call
// var_dump(hash_file('md5', 'https://cdn.statically.io/screenshot/www.develssssssssssssssopers.eu.org'));
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://cdn.statically.io/screenshot/google.com');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
// 	'User-Agent: request'
// ));
// $output_faker = curl_exec($ch);
// curl_close($ch);

// var_dump($output_faker);

$get_help_files = file_get_contents('slangword.json');
$helper = json_decode($get_help_files, true);
var_dump($helper['corona']);
