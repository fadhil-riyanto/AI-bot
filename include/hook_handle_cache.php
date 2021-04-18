<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';

function hooh_db_handle_filter()
{
    if (filemtime(__DIR__ . '/../include/hook_filter_handle.txt') < time() - 1 * 30) {
        // declare database connection details
        $servername = DB_HOST;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $database = DB_NAME;
        $dbport = 3306;
        // create connection to database
        $db = new mysqli($servername, $username, $password, $database, $dbport);

        if ($db->connect_errno) {
            return "error_conn";
            exit();
        }
        // make the SQL call
        if ($result = $db->query("SELECT * FROM filters_word_data")) {
            $rows = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }


            // store query result in hook_filter_handle.txt
            file_put_contents(__DIR__ . '/../include/hook_filter_handle.txt', serialize(json_encode($rows)));

            return json_encode($rows);
        } else {
            return 'error_db';
        }
    } else {
        $data = unserialize(file_get_contents(__DIR__ . '/../include/hook_filter_handle.txt'));
        return $data;
    }
}

// echo auth_api_getdata();
