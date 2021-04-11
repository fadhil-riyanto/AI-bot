<?php
if (isset($_COOKIE['auth_fadhil_login'])) {
    unset($_COOKIE['auth_fadhil_login']);
    setcookie('auth_fadhil_login', null, -1, '/');
    header("location: /docs");
    return true;
} else {
    header("location: /docs");
    return false;
}
