
<?php

$key = implode('-',str_split(substr(strtolower(hash('sha256',microtime() . rand(1000, 9999))),0,30),6));

/*
require __DIR__ . '/env.php';
require __DIR__ . '/../pengaturan/env.php';
require __DIR__ . '/../vendor/autoload.php';

if (!isset($_COOKIE["auth_fadhil_login"])) {
    $isLogin = false;
} else {
    $apiskeys = $_COOKIE["auth_fadhil_login"];
    require __DIR__ . '/../include/api_oauthsystem.php';
    $getjsondbmysql = auth_api_getdata();
    if ($getjsondbmysql == 'error_conn') {
        $errordb = true;
    } elseif ($getjsondbmysql == 'error_db') {
        $errordb = true;
    } else {
        $apicheck = json_decode($getjsondbmysql);
        foreach ($apicheck as $keys) {
            if (hash('sha512', $keys->key) == $apiskeys) {
                $apikey_check = true;
                $keyapis = $keys->key;
                $nameapiss = $keys->name;
            }
        }
    }

    if ($apikey_check == true) {
        if (isset($_POST['update_kredensial'])) {

            $updatekredensial_nama = $_POST['nama'];
            $updatekredensial_username_telegram = $_POST['username_telegram'];
            $updatekredensial_password = $_POST['password'];

            $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $db->query("UPDATE `b8rkwqqp7tbpt89flosy`.`api_data` 
        SET `key`='" . $keyapis . "' 
        WHERE  `key`='" . $keyapis . "' AND 
        `nama`='admin' AND 
        `username_telegram`='John' AND 
        `password`='Doeeeeeeeeeeeeeee' LIMIT 1");
        }

        // $db->query("UPDATE `api_data` 
        // SET `key`='c643b8-799f1b-cdd505-5471b5-01c0da' 
        // WHERE  `key`='c643b8-799f1b-cdd505-5471b5-01c0da' AND 
        // `nama`='" . $updatekredensial_nama . "' AND 
        // `username_telegram`='" . $updatekredensial_username_telegram . "' AND 
        // `password`='" . $updatekredensial_password . "' LIMIT 1");
        // }
        $isLogin = true;
    } else {
        // header("location:auth/");
        // exit();
        $isLogin = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title><?= $htmltitle; ?></title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="sidebar-brand-text mx-3"><?= $namaapis ?></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>

            <?php
            $a = json_decode(file_get_contents('nav.json'));
            foreach ($a as $aa) {
                echo '<li class="nav-item">
        <a class="nav-link" href="doc.php?data=' . $aa->get_load . '">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>' . $aa->group . '</span>
        </a>
      </li>';
            }
            ?>

            <hr class="sidebar-divider">
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">

                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">


                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">

                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">


                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <?php
                            if ($isLogin == true) {
                                echo '<a class="nav-link" href="delete_auth.php" id="userDropdown" role="button">
                logout

              </a>';
                            } else {
                                echo '<a class="nav-link" href="auth/" id="userDropdown" role="button">
                Login

              </a>';
                            }
                            ?>
                            <?php
                            if ($profilemode == true) {
                                echo '<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="login.html">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>';
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Basic -->
                            <div class="card mb-12">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Informasi kamu</h6>
                                </div>
                                <div class="card-body">
                                    <form action='' method='POST'>
                                        <div class="form-group">
                                            <label for="textinput">Nama kamu</label>
                                            <input type="text" name='nama' class="form-control" id="textinput" aria-describedby="emailHelp" placeholder="Masukkan nama (Opsional)">
                                            <small id="emailHelp" class="form-text text-muted">Nama digunakan untuk menyapa kamu</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="usernametg-input">Username telegram</label>
                                            <input name='username_telegram' type="text" class="form-control" id="usernametg-input" placeholder="username telegram (untuk autentikasi lupa password)">
                                        </div>
                                        <div class="form-group">
                                            <label for="password-tg-inputt">Password</label>
                                            <input name='password' type="password" class="form-control" id="password-tg-inputt" placeholder="Password (untuk login)">
                                        </div>
                                        <button type="submit" name='update_kredensial' class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Form Sizing -->
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revoke API key</h6>
                                </div>
                                <div class="card-body">
                                    <p>Apikey sekarang : <code class="highlighter-rouge">983ruoir-834-2344-234uw</code></p>
                                    <button type="button" class="btn btn-primary">Revoke APIkey</button>
                                </div>
                            </div>
                        </div>


                        <!---Container Fluid-->
                    </div>
                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>copyright &copy; <script>
                                        document.write(new Date().getFullYear());
                                    </script> - developed by
                                    <b><a href="<?= $githublinkdev ?>" target="_blank"><?= $devname ?></a></b>
                                </span>
                            </div>
                        </div>
                    </footer>
                    <!-- Footer -->
                </div>
            </div>

            <!-- Scroll to top -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="js/ruang-admin.min.js"></script>
            <script src="vendor/chart.js/Chart.min.js"></script>
            <script src="js/demo/chart-area-demo.js"></script>
</body>

</html>/*