<?php
function time_ai($text)
{
    $arr = preg_split('#(?<=\d)(?=[a-z])#i', $text);
    if (is_numeric($arr[0])) {
    } else {
        $arr = preg_split('#(?<=\d) (?=[a-z])#i', $text);
    }
    if (isset($arr[1])) {
        if ($arr[1] == 'm') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'minute') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'menit') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'minit') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'mins') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'min') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'j') {
            $mentah1 = array('time' => $arr[0], 'type' => 'hours');
        } elseif ($arr[1] == 'jam') {
            $mentah1 = array('time' => $arr[0], 'type' => 'hours');
        } elseif ($arr[1] == 'h') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        } elseif ($arr[1] == 'hari') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        } elseif ($arr[1] == 'day') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        } elseif ($arr[1] == 'd') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        }
    } else {
        if ($arr[0] == 'u') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'inf') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'selamanya') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'tanpa batas') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'unlimited') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'gaada batas') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } else {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        }
        //$mentah1 = array('time' => $arr[0], 'type' => 'minute');
    }
    if ($mentah1['time'] == null && $mentah1['type'] == 'infinity') {
        return null;
    } elseif ($mentah1['time'] != null && $mentah1['type'] != 'infinity') {
        if ($mentah1['type'] == 'minute') {
            $timeunik = $mentah1['time'] * 60;
        } elseif ($mentah1['type'] == 'hours') {
            $timeunik = $mentah1['time'] * 60 * 60;
        } elseif ($mentah1['type'] == 'day') {
            $timeunik = $mentah1['time'] * 60 * 60 * 24;
        }
    }

    return time() + $timeunik;
}
date_default_timezone_set('Asia/Jakarta');
$timestampp = time_ai('selamanya');
echo "unix : " . $timestampp . PHP_EOL;
echo "human : " . date('Y-m-d h:i:s', $timestampp);
