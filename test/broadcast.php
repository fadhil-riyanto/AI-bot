<?php
require __DIR__ . "/../vendor/autoload.php";

$telegram = new Telegram('1489990155:AAEUjetEoXH731jog87hrb5IlqOvh8WjyJ8');

$a = "1393342467,960805181,466284462,1455250320,1195226552,1253079946,388685359,1416099345,1355798219,855538973,1426501098,1027931343,1312222500,350906598,1349919799,1651535264,1397251966,617426792,1667117065,1673122236,1421555737,1341966935,1676828198,1095543469,1574512037,1190370999,1155470476,1339101168,1616801341,1418773977,1673590596,1706561731,76414315,1735453766,286531072,64860694,605166480,1318335075,1154989698,831666755,1582208820,1468853576,1394335657,874922966,1184720056,938740797,1386887236,1465753780,1309404507,1461431695,1321856967,1048718804,1140184040,1630744476,1716204763,1473867103,1396175819,414079950,1192566681,1757169682,1640611600,1083846126,966509070,213567634,1305124234,1081157279,724677596,1319343498,1356375742,1781086819,1641144134,1270194202,1342484568,1780527812,1891678367,633004612,1398688205,792364159";
//$a = "1393342467,1223173857,1455250320";
$bb = explode(",", $a);

$teks = "[BROADCAST_ADMIN]" . PHP_EOL . PHP_EOL .
    "Saya sebagai developer bot ini." . PHP_EOL .
    "ingin mengucapkan selamat hari raya Idul Fitri untuk saudaraku umat muslim dan selamat memperingati Kenaikan Isa Al Masih untuk saudaraku umat kristiani." . PHP_EOL . PHP_EOL .
    "Karna saya muslim, maka sepatutnya meminta maaf apabila ada salah, seperti spam /ping di grup, sering ngetag orang ga jelas, sampai send stiker yang mungkin agak ga enak bagi kalian semua." . PHP_EOL .
    "semoga pada hari raya idul fitri ini, semua kesalahan saya bisa dimaafkan" . PHP_EOL . PHP_EOL .
    "yen ono lepate njaluk dingapuroni...";
foreach ($bb as $bbs) {

    $content = array('chat_id' => $bbs, 'text' => $teks, 'parse_mode' => 'html');
    $result = $telegram->sendMessage($content);
    if ($result['ok'] === true) {
        echo $bbs . ' : terkirim' .  PHP_EOL;
    } else {
        echo $bbs . ' : tidak terkirim' .  PHP_EOL;
    }
}
