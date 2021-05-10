<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';
require __DIR__ . '/../include/conn_db.php';



function getChatAdministrators_admincache()
{
    if (filemtime(__DIR__ . '/../include/getChatAdministrators_admincache.txt') < time() - 1 * 60) {
        global $chat_id, $telegram;

        $content = array('chat_id' => $chat_id);
        $result = $telegram->getChatAdministrators($content);


        // make the SQL call
        if ($result) {
            // store query result in getChatAdministrators_admincache.txt
            file_put_contents(__DIR__ . '/../include/getChatAdministrators_admincache.txt', serialize(json_encode($result)));

            return json_encode($result);
        } else {
            return 'error_fetch_data';
        }
    } else {
        $data = unserialize(file_get_contents(__DIR__ . '/../include/getChatAdministrators_admincache.txt'));
        return $data;
    }
}

// echo auth_api_getdata();
