<?php

require __DIR__ . '/env.php';
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
    $isLogin = true;
  } else {
    // header("location:auth/");
    // exit();
    $isLogin = false;
  }
}

function get_client_ipaddr()
{
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if (isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if (isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if (isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

function convertnem($size)
{
  $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
  return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
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
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/css/ruang-admin.min.css" rel="stylesheet">
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
                echo '<a class="nav-link" href="' . $_SERVER['REQUEST_URI'] . '/delete_auth.php" id="userDropdown" role="button">
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
          <!-- Attention -->
          <div class="alert alert-primary alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Selamat datang
            <?= $nameapiss ?>
          </div>




          <!-- Attention -->
          <?php
          if ($isLogin == true) {
            echo '<div class="row mb-3">
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Jam</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
            
            <body onLoad="initClock()">
            <div id="timedate">
              <a id="d">1</a>
              <a id="mon">January</a>
              <a id="y">0</a><br />
              <a id="h">12</a> :
              <a id="m">00</a>:
              <a id="s">00</a>:
              <a id="mi">000</a>
            </div>

            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Earnings (Annual) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">IP</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
            
            ' . get_client_ipaddr() . '

            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- New User Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">Ram</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
            
            ' . convertnem(memory_get_usage(true)) . '

            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">PHP version</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
            
            ' . phpversion() . '

            </div>

          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Pending Requests Card Example -->
  
</div>';
          } else {
            echo '<div class="row">
<div class="col-lg-12">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">' . $titleindex . '</h6>
    </div>
    <div class="card-body">
      ' . $body . '
    </div>

  </div>
</div>
</div>';
          }

          ?>

          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
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
  <script>
    // START CLOCK SCRIPT

    Number.prototype.pad = function(n) {
      for (var r = this.toString(); r.length < n; r = 0 + r);
      return r;
    };

    function updateClock() {
      var now = new Date();
      var milli = now.getMilliseconds(),
        sec = now.getSeconds(),
        min = now.getMinutes(),
        hou = now.getHours(),
        mo = now.getMonth(),
        dy = now.getDate(),
        yr = now.getFullYear();
      var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"];
      var tags = ["mon", "d", "y", "h", "m", "s", "mi"],
        corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2), milli];
      for (var i = 0; i < tags.length; i++)
        document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
    }

    function initClock() {
      updateClock();
      window.setInterval("updateClock()", 1);
    }

    // END CLOCK SCRIPT
  </script>

  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/js/ruang-admin.min.js"></script>
  <script src="/vendor/chart.js/Chart.min.js"></script>
  <script src="/js/demo/chart-area-demo.js"></script>
</body>

</html>