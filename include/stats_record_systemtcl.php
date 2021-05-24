<?php
//gettting datanya user dan userid
$detekapakahstatstersedia = file_exists(__DIR__ . '/../json_data/stats_data/' . $userID . '.frfs');
if ($detekapakahstatstersedia == false) {
    file_put_contents(__DIR__ . '/../json_data/stats_data/' . $userID . '.frfs', '1 ' . $userID);
    $resultan_stats = file_get_contents(__DIR__ . '/../json_data/stats_data/' . $userID . '.frfs', '1 ' . $userID);
    $HASILstats_meledak = explode(' ', $resultan_stats);
} else {
    $resultan_stats = file_get_contents(__DIR__ . '/../json_data/stats_data/' . $userID . '.frfs', '1 ' . $userID);
    $HASILstats_meledak = explode(' ', $resultan_stats);
    file_put_contents(__DIR__ . '/../json_data/stats_data/' . $userID . '.frfs', $HASILstats_meledak[0] + 1 . ' ' . $userID);
}

if($HASILstats_meledak[0] > 5){
    
}