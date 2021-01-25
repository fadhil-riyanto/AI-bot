<?php
// switch ($h_weat->current->condition->code) {
//     case '1000':
//         $kondisi_cuaca = 'Cerah';
//         break;
//     case '1003':
//         $kondisi_cuaca = 'Berawan';
//         break;
//     case '1006':
//         $kondisi_cuaca = 'Berawan';
//         break;
//     case '1009':
//         $kondisi_cuaca = 'Mendung';
//         break;
//     case '1030':
//         $kondisi_cuaca = 'Kabut';
//         break;
//     case '1063':
//         $kondisi_cuaca = 'Kemungkinan hujan tidak merata';
//         break;
//     case '1066':
//         $kondisi_cuaca = 'Kemungkinan salju tidak merata';
//         break;
//     case '1069':
//         $kondisi_cuaca = 'Hujan es tidak merata mungkin';
//         break;
//     case '1072':
//         $kondisi_cuaca = 'Mungkin gerimis beku tidak merata';
//         break;
//     case '1087':
//         $kondisi_cuaca = 'Petir mungkin terjadi';
//         break;
//     case '1114':
//         $kondisi_cuaca = 'Berhembus salju';
//         break;
//     case '1117':
//         $kondisi_cuaca = 'Badai salju';
//         break;
//     case '1135':
//         $kondisi_cuaca = 'Kabut';
//         break;
//     case '1147':
//         $kondisi_cuaca = 'Kabut beku';
//         break;
//     case '1150':
//         $kondisi_cuaca = 'Gerimis ringan tidak merata';
//         break;
//     case '1153':
//         $kondisi_cuaca = 'Gerimis ringan';
//         break;
//     case '1168':
//         $kondisi_cuaca = 'Gerimis yang membekukan';
//         break;
//     case '1171':
//         $kondisi_cuaca = 'Gerimis beku lebat';
//         break;
//     case '1180':
//         $kondisi_cuaca = 'Hujan ringan tidak merata';
//         break;
//     case '1183':
//         $kondisi_cuaca = 'Gerimis';
//         break;
//     case '1186':
//         $kondisi_cuaca = 'Hujan sedang';
//         break;
//     case '1189':
//         $kondisi_cuaca = 'Hujan sedang';
//         break;
//     case '1192':
//         $kondisi_cuaca = 'Terkadang hujan deras';
//         break;
//     case '1195':
//         $kondisi_cuaca = 'Hujan deras';
//         break;
//     case '1198':
//         $kondisi_cuaca = 'Hujan dingin ringan';
//         break;
//     case '1201':
//         $kondisi_cuaca = 'Hujan beku sedang atau lebat';
//         break;
//     case '1204':
//         $kondisi_cuaca = 'Hujan es ringan';
//         break;
//     case '1207':
//         $kondisi_cuaca = 'Hujan es sedang atau berat';
//         break;
//     case '1210':
//         $kondisi_cuaca = 'Salju ringan tidak merata';
//         break;
//     case '1213':
//         $kondisi_cuaca = 'Salju ringan';
//         break;
//     case '1216':
//         $kondisi_cuaca = 'Salju sedang tidak merata';
//         break;
//     case '1219':
//         $kondisi_cuaca = 'Salju sedang';
//         break;
//     case '1222':
//         $kondisi_cuaca = 'Salju lebat tidak merata';
//         break;
//     case '1225':
//         $kondisi_cuaca = 'Salju lebat';
//         break;
//     case '1237':
//         $kondisi_cuaca = 'Pelet es';
//         break;
//     case '1240':
//         $kondisi_cuaca = 'Pancuran hujan ringan';
//         break;
//     case '1243':
//         $kondisi_cuaca = 'Pancuran hujan sedang atau lebat';
//         break;
//     case '1246':
//         $kondisi_cuaca = 'Hujan deras';
//         break;
//     case '1249':
//         $kondisi_cuaca = 'Hujan es ringan';
//         break;
//     case '1252':
//         $kondisi_cuaca = 'Hujan es sedang atau lebat';
//         break;
//     case '1255':
//         $kondisi_cuaca = 'Hujan salju ringan';
//         break;
//     case '1258':
//         $kondisi_cuaca = 'Hujan salju sedang atau lebat';
//         break;
//     case '1261':
//         $kondisi_cuaca = 'Hujan es butiran es';
//         break;
//     case '1264':
//         $kondisi_cuaca = 'Hujan butiran es sedang atau deras';
//         break;
//     case '1273':
//         $kondisi_cuaca = 'Hujan ringan tidak merata dengan guntur';
//         break;
//     case '1276':
//         $kondisi_cuaca = 'Hujan sedang atau lebat disertai guntur';
//         break;
//     case '1279':
//         $kondisi_cuaca = 'Salju ringan tidak merata dengan guntur';
//         break;
//     case '1282':
//         $kondisi_cuaca = 'Salju sedang atau lebat disertai guntur';
//         break;

//     default:
//         $kondisi_cuaca = 'Hubungi @fadhil_riyanto untuk bug kondisi cuaca!';
//         break;
// }
$xml = simplexml_load_file('https://data.bmkg.go.id/datamkg/MEWS/DigitalForecast/DigitalForecast-Indonesia.xml');
$json = json_encode($xml);
$json_d = json_decode($json);
// echo $json;
echo $json_d->forecast->issue->year;
