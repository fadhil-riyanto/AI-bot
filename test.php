<?php

$teksTerfilter = 'yg mati apa nya?';
$data_simsimi = file_get_contents('https://simsumi.herokuapp.com/api?text=' . urlencode($teksTerfilter) . '&lang=id');
$sim_decode = json_decode($data_simsimi);
$data_filetr_sim = hyphenize($sim_decode->success);


echo $data_filetr_sim;
function hyphenize($string)
{
	$dict = array(
		'simi' => 'fadhil riyanto',
		'knp' => 'kenapa',
		'yoi' => 'iya'

		// replace teks lainnya disini
	);
	return strtolower(
		preg_replace(
			array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
			array(' ', ''),

			cleanString(
				str_replace(
					array_keys($dict),
					array_values($dict),
					urldecode($string)
				)
			)
		)
	);
}
function cleanString($text)
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
