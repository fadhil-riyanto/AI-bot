<?php
require __DIR__ . '/../vendor/autoload.php';

function blacklist_user()
{
    global $db, $db_error_koneksi;
    if (filemtime(__DIR__ . '/../include/blacklist_user.txt') < time() - 1 * 10) {
        // declare database connection details

        if ($db_error_koneksi) {
            return "error_conn";
            exit();
        }
        // make the SQL call
        $user = $db->run(
            "SELECT * FROM blacklist_user"
        );
        if ($user) {

            // store query result in blacklist_user.txt
            file_put_contents(__DIR__ . '/../include/blacklist_user.txt', serialize(json_encode($user)));

            return json_encode($user);
        } else {
            return 'error_db';
        }
    } else {
        $data = unserialize(file_get_contents(__DIR__ . '/../include/blacklist_user.txt'));
        return $data;
    }
}

// echo auth_api_getdata();
