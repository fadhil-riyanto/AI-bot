<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';

function hooh_db_handle_filter()
{
    global $db, $db_error_koneksi;
    if (filemtime(__DIR__ . '/../include/hook_filter_handle.txt') < time() - 1 * 30) {
        // declare database connection details

        $user = $db->run(
            "SELECT * FROM filters_word_data"
        );
        if ($user) {
            // store query result in hook_filter_handle.txt
            file_put_contents(__DIR__ . '/../include/hook_filter_handle.txt', serialize(json_encode($user)));

            return json_encode($user);
        } else {
            return 'error_db';
        }
    } else {
        $data = unserialize(file_get_contents(__DIR__ . '/../include/hook_filter_handle.txt'));
        return $data;
    }
}

// echo auth_api_getdata();
