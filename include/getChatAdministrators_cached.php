<?php
require __DIR__ . '/../vendor/autoload.php';

function dapatkan_admin($chat_id)
{
    global $telegram;
    //deteksi apakah file ada
    $deteksicacheadmin = file_exists(__DIR__ . '/../json_data/admin_cache_json/cache_id_' . $chat_id);
    if ($deteksicacheadmin === false) {
        $data = array('chat_id' => $chat_id);
        $adminnn = $telegram->getChatAdministrators($data);
        file_put_contents(__DIR__ . '/../json_data/admin_cache_json/cache_id_' . $chat_id, json_encode($adminnn));
        return $adminnn;
    }

    if (filemtime(__DIR__ . '/../json_data/admin_cache_json/cache_id_' . $chat_id) < time() - 1 * 5) {
        $data = array('chat_id' => $chat_id);
        $adminnn = $telegram->getChatAdministrators($data);
        file_put_contents(__DIR__ . '/../json_data/admin_cache_json/cache_id_' . $chat_id, json_encode($adminnn));
        return $adminnn;
    } else {
        return json_decode(file_get_contents(__DIR__ . '/../json_data/admin_cache_json/cache_id_' . $chat_id), true);
    }
}
