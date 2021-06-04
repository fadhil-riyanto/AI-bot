<?php 
$string = 'he‎ran';
$result = str_replace('‎', null, $string);

// $bads=array(
//     'herans',
// 	'he‎ran', //unicode
// 	'heran' //non unicode
// );
// foreach ($bads as $bad) {
//     if (strpos($string, $bad) !== false) {
//         echo 'detek';
//         exit;
//     } else {
//         echo "Good";
//     }
// }

echo json_encode($result);