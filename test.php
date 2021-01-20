<?php

$mysqli = new mysqli("freedb.tech", "freedbtech_ai_bot_fadhil_riyanto", "789b697698hyufijbbiub*&^BO&it87tbn7to&^7896", "freedbtech_ai_bot_fadhil_riyanto");

// check connection
if ($mysqli->connect_errno) {
	die("Connect failed: " . $mysqli->connect_error);
}
$text = 'fia';
$query = "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$text' ";
$result = $mysqli->query($query);

while ($row = $result->fetch_array()) {
	// echo 'key :' . $row['data_key_ai'] . PHP_EOL .  'res' . $row['data_res_ai'] . PHP_EOL;
	if ($row['data_key_ai'] == $text) {
		echo $row['data_res_ai'];
		exit;
	} elseif ($row['data_key_ai'] != $text) {
		echo $row['data_res_ai'];
		exit;
	}
}
