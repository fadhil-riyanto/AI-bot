<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';

function db_members_cached()
{
    global $db, $db_error_koneksi;
    if (filemtime(__DIR__ . '/../include/cached_members.txt') < time() - 1 * 20) {
        // declare database connection details
        $user = $db->run(
            "SELECT * FROM filters_word_data"
        );
        if ($user) {

            // store query result in cached_members.txt
            file_put_contents(__DIR__ . '/../include/cached_members.txt', serialize(json_encode($user)));

            return json_encode($user);
        } else {
            return 'error_db';
        }
    } else {
        $data = unserialize(file_get_contents(__DIR__ . '/../include/cached_members.txt'));
        return $data;
    }
}

// echo auth_api_getdata();
