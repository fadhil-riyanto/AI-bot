<?php
require 'sumber.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $res = $_POST['res'];
    masukkan_data($id, $res);
}
