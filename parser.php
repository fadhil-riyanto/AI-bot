<?php
error_reporting(0);
//inculde semua file
function setVariabel($name, $value)
{
    $_SESSION[$name] = $value;
}

$a = $argv[1];

if(isset($_GET['kode'])){
	$baca = $_GET['kode'];
}
$mulai_perbaris = explode(PHP_EOL, $baca);

foreach ($mulai_perbaris as $for_mulai) {
    $pisahkan = explode('::', $for_mulai);
    foreach ($pisahkan as $for_Pisahkan) {
        if ($for_Pisahkan == 'tulis') {
            $rep = str_replace('tulis::', '', $for_mulai);
            echo $rep;
        } elseif ($for_Pisahkan == '#') {
            continue;
        } elseif ($for_Pisahkan == '<?fadhil') {
            continue;
        } elseif ($for_Pisahkan == '?>') {
            exit;
        } elseif ($for_Pisahkan == '/n') {
            echo PHP_EOL;
        } elseif ($for_Pisahkan == 'acak') {
            echo rand();
        } elseif ($for_Pisahkan == 'var') {
            $rep = str_replace('var::', '', $for_mulai);
            $h = explode('::', $rep);
            if (!isset($h[0])) {
                echo 'Error yang fatal. KEY var tidak ditemukan. ERR syntax';
            } elseif (!isset($h[1])) {
                echo 'Error yang fatal. VALUE var tidak ditemukan. ERR syntax';
            } elseif ($h[1] == 'lihat_bool') {
                setVariabel($h[0], $h[1]);
                echo 'BOOL: 1';
            } else {
                setVariabel($h[0], $h[1]);
            }
        } elseif ($for_Pisahkan == 'lihat_var') {
            $rep = str_replace('lihat_var::', '', $for_mulai);
            $h = explode('::', $rep);
            if (!isset($h[0])) {
                echo 'Error yang fatal. KEY var tidak ditemukan. ERR syntax';
            } else {
                echo $_SESSION[$h[0]];
            }
        } elseif ($for_Pisahkan == 'base64') {
            $rep = str_replace('ulang::', '', $for_mulai);
            $h = explode('::', $rep);
            if (!isset($h[0])) {
                echo 'Error yang fatal. STR tidak ditemukan. ERR syntax';
            } else {
                echo base64_encode($h[0]);
            }
        } elseif ($for_Pisahkan == 'ulang') {
            $rep = str_replace('ulang::', '', $for_mulai);
            $h = explode('::', $rep);
            if (!isset($h[0])) {
                echo 'Error yang fatal. INT parameters tidak ditemukan. ERR syntax';
            } elseif (!isset($h[1])) {
                echo 'Error yang fatal. STR tidak ditemukan. ERR syntax';
            } elseif (@$h[2] == '/n') {
                for ($a = 1; $a <= $h[0]; $a++) {
                    echo $h[1] . PHP_EOL;
                }
            } else {
                for ($a = 1; $a <= $h[0]; $a++) {
                    echo $h[1];
                }
            }
        } elseif ($for_Pisahkan == 'jika') {
            $rep = str_replace('jika::', '', $for_mulai);
            $h = explode('::', $rep);
            switch ($h[1]) {
                case '>':
                    $booleanJika = $h[0] > $h[2];
                    break;

                case '<':
                    $booleanJika = $h[0] < $h[2];
                    break;

                case '<=':
                    $booleanJika = $h[0] <= $h[2];
                    break;

                case '==':
                    $booleanJika = $h[0] == $h[2];
                    break;

                case '===':
                    $booleanJika = $h[0] === $h[2];
                    break;

                case '||':
                    $booleanJika = $h[0] || $h[2];
                    break;

                default:
                    echo 'Notifikasi : argument tidak valid!' . PHP_EOL;
                    echo 'Thread sistem : ' . bin2hex(rand(1, 888999));
                    break;
            }
            if ($booleanJika == 1) {
                echo $h[3];
            } else {
                echo $h[4];
            }
        } elseif ($for_Pisahkan == 'matematika') {
            $rep = str_replace('matematika::', '', $for_mulai);
            $h = explode('::', $rep);
            switch ($h[1]) {
                case '+':
                    echo $h[0] + $h[2];
                    break;

                case '-':
                    echo $h[0] - $h[2];
                    break;

                case '*':
                    echo $h[0] * $h[2];
                    break;

                case '/':
                    echo $h[0] / $h[2];
                    break;

                case '%':
                    echo $h[0] % $h[2];
                    break;

                default:
                    echo 'Notifikasi : Modul selain operasi matematika tidak ditemukan. tersedia +-/*%' . PHP_EOL;
                    echo 'Thread sistem : ' . bin2hex(rand(1, 888999));
                    break;
            }
            //var_dump($math);
        } elseif ($for_Pisahkan == 'systemOut.akhiri_program') {
            echo PHP_EOL . PHP_EOL . PHP_EOL . 'Procces excited in ' . date('h:i');
        }
    }
}
