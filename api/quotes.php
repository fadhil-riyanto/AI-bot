<?php
error_reporting(0);
function check_http_apis($keyid)
{
	$getapikey = file_get_contents(__DIR__ . '/../json_data/apikey.json');
	$apikeydec = json_decode($getapikey);
	foreach ($apikeydec as $apikey) {
		if ($apikey->keyid == $keyid) {
			return true;
		}
	}
}
if (isset($_GET['keyid'])) {
	$checkkoneksihttpisvalid = check_http_apis($_GET['keyid']);
	if ($checkkoneksihttpisvalid == true) {
		$getquotesjson = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/quot.json');
		$quotesdecjson = json_decode($getquotesjson);
		$countingquotes = count($quotesdecjson);
		$array = array(
			"status" => true,
			"quotes" => $quotesdecjson[random_int(1, $countingquotes)]->quotes,
			"by" => $quotesdecjson[random_int(1, $countingquotes)]->by
		);
		echo json_encode($array);
	} else {
		$array = array(
			"status" => false,
			"quotes" => null,
			"by" => null
		);
		echo json_encode($array);
	}
} else {
	$array = array(
		"status" => "404 not found",
		"quotes" => null,
		"by" => null
	);
	echo json_encode($array);
}
