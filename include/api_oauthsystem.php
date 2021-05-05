<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';
require __DIR__ . '/../include/conn_db.php';



function auth_api_getdata()
{
    if (filemtime(__DIR__ . '/../include/db_cach.txt') < time() - 1 * 60) {
        global $db, $db_error_koneksi;

        if ($db_error_koneksi) {
            return "error_conn";
            exit();
        }
        $result = $db->run("SELECT * FROM api_data");


        // make the SQL call
        if ($result) {
            // store query result in db_cach.txt
            file_put_contents(__DIR__ . '/../include/db_cach.txt', serialize(json_encode($result)));

            return json_encode($result);
        } else {
            return 'error_db';
        }
    } else {
        $data = unserialize(file_get_contents(__DIR__ . '/../include/db_cach.txt'));
        return $data;
    }
}

// echo auth_api_getdata();
