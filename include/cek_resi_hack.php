<?php
function kurir_resi_cek($string)
{
    $string = strtolower($string);
    $dict = array(
        'jne express' => 'jne',
        'jne' => 'jne',
        'pos indonesia' => 'pos',
        'pos' => 'pos',
        'j&t express indonesia' => 'jnt',
        'jnt' => 'jnt',
        'j&t' => 'jnt',
        'sicepat' => 'sicepat',
        'tiki' => 'tiki',
        'anteraja' => 'anteraja',
        'wahana' => 'wahana',
        'ninja express' => 'ninja',
        'express' => 'ninja',
        'lion parcel' => 'lion',
        'lion' => 'lion',
        'pcp express' => 'pcp',
        'pcp' => 'pcp',
        'jet express' => 'jet',
        'jet' => 'jet',
        'rex express' => 'rex',
        'rex' => 'rex',
        'first logistics' => 'first',
        'first' => 'first',
        'id express' => 'ide',
        'ide' => 'ide',
        'shopee express' => 'spx',
        'spx' => 'spx',
        'kgxpress' => 'kgx',
        'kgx' => 'kgx',
        'sap express' => 'sap',
        'sap' => 'sap'
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}
function resi_chek_apakah_tersedia($file_json, $kurir, $awb)
{
    $getjsonapis = file_get_contents($file_json);
    $getjsonapis_dec = json_decode($getjsonapis);
    if (count($getjsonapis_dec) == 0) {
        return 'error';
    }
    //coba 1
    $cekkurir = kurir_resi_cek($kurir);
    if ($cekkurir == false) {
        return 'courier null';
    } else {
        $kurir = $cekkurir;
        get_apis:
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.binderbyte.com/v1/track?api_key=" . $getjsonapis_dec[0]->api_key . "&courier=" . $kurir . "&awb=" . $awb);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $hasilapi = json_decode($output);
        if (json_last_error() === JSON_ERROR_NONE) {
            if ($hasilapi->status == 400) {
                if ($hasilapi->message == 'API Key not found, visit http://binderbyte.com for more information') {
                    array_shift($getjsonapis_dec);
                    $arr = json_encode($getjsonapis_dec, JSON_PRETTY_PRINT);
                    file_put_contents($file_json, $arr);
                    goto get_apis;
                } elseif ($hasilapi->message == 'Courier not found') {
                    return 'courier null';
                } elseif ($hasilapi->message == 'Data not found') {
                    return 'data null';
                }
            } elseif ($hasilapi->status == 200) {
                return $output;
            }
        }
    }
}

//echo resi_chek_apakah_tersedia('api_list.json', 'sicepat', '000482798704');
