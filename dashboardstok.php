<?php 
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'dwadventure';

$connect = mysqli_connect($host, $user, $password, $db);
if(!$connect){
    die('koneksi db gagal'.mysqli_error($connect));
}

$qty = 0;

$query = "SELECT l.nama as nama,
SUM(f.quantity) AS quantity
FROM tabelfaktastok f
join lokasiinventory l on f.idLokasi = l.idLokasi
GROUP BY f.idLokasi
ORDER BY f.idLokasi";

$fetch = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($fetch)){
  $data[] = $row['quantity'];
  $nama[] = $row['nama'];
  $qty += $row['quantity'];
}

$json_encode = $data;
$json_nama = $nama;

// query tabel stok
$querytblstok = "SELECT p.nama as nama,
SUM(f.quantity) AS quantity
FROM produk p
join tabelfaktastok f on p.idProduk = f.idProduk
join lokasiinventory l on f.idLokasi = l.idLokasi
where l.idLokasi = '10'
GROUP BY p.idProduk
ORDER BY quantity asc
limit 10;";
$tblstok = mysqli_query($connect, $querytblstok);

// query tabel stok
$querytbl50 = "SELECT p.nama as nama,
SUM(f.quantity) AS quantity
FROM produk p
join tabelfaktastok f on p.idProduk = f.idProduk
join lokasiinventory l on f.idLokasi = l.idLokasi
where l.idLokasi = '50'
GROUP BY p.idProduk
ORDER BY quantity asc
limit 10;";
$tbl50 = mysqli_query($connect, $querytbl50);

// query tabel stok
$querytbl60 = "SELECT p.nama as nama,
SUM(f.quantity) AS quantity
FROM produk p
join tabelfaktastok f on p.idProduk = f.idProduk
join lokasiinventory l on f.idLokasi = l.idLokasi
where l.idLokasi = '60'
GROUP BY p.idProduk
ORDER BY quantity asc
limit 10;";
$tbl60 = mysqli_query($connect, $querytbl60);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DWOBOSZZH | Dashboard Stok</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    .tabelstok{
      margin: 0 auto;
    }
    .h3tp{
      text-align : center;
    }
    .pepepe{
      margin-top: -30px;
    }
  </style>
  

  <script>
    function funSembunyi(){
      var x = document.getElementById("tabel1");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }

      var x = document.getElementById("tabel2");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }

      var x = document.getElementById("tabel3");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }

      var x = document.getElementById("teksdata10");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DWO BOZZH!!!</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/hensem.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block">Adalah Gwehj</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./dashboardpenjualan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./dashboardstok.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Stok</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Dashboard Stok</b></h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="column">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h4 class=""><b>Stok</b></h4>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column pepepe">
                    <span>Total Stok</span>
                    <span class="text-bold text-lg text-primary mb-4"><?php echo $qty?> Unit</span>
                    <span>Quantity</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <a href="#" onclick="funSembunyi()">
                  <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                  </div>
                </a>

                <div class="d-flex flex-row justify-content-between">
                  <h6 class="">Klik pada diagram untuk melihat detail data</h6>
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Lokasi
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <h3 id="teksdata10" class="m-0 mt-4 mb-4 h3tp"><b>Data 10 Stok Terendah</b></h3>

          <div class="d-flex flex-row justify-content-between" >
            <!-- FRAME FORMING -->
            <div class="col-md-4 tabelstok">
              <div class="card">
                <div id="tabel1" class="card-body">
                  <h5 class="m-0 mb-4 h3tp"><b>Frame Forming</b></h5>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th  width="35%"><center>Nama Produk</center></th>
                                  <th  width="25%"><center>Stok</center></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                                while($row = mysqli_fetch_array($tblstok)){
                                  echo "<tr>";
                                  echo "<td><center>".$row['nama']."</center></td>";
                                  echo "<td><center>".$row['quantity']."</center></td>";
                                  echo "</tr>";
                                }
                              ?>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- SubAssembly -->
            <div class="col-md-4 tabelstok">
              <div class="card">
                <div id="tabel2" class="card-body">
                  <h5 class="m-0 mb-4 h3tp"><b>Sub Assembly</b></h5>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th  width="35%"><center>Nama Produk</center></th>
                                  <th  width="25%"><center>Stok</center></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                                while($row = mysqli_fetch_array($tbl50)){
                                  echo "<tr>";
                                  echo "<td><center>".$row['nama']."</center></td>";
                                  echo "<td><center>".$row['quantity']."</center></td>";
                                  echo "</tr>";
                                }
                              ?>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Final Assembly -->
            <div class="col-md-4 tabelstok">
              <div class="card">
                <div id="tabel3" class="card-body">
                  <h5 class="m-0 mb-4 h3tp"><b>Final Assembly</b></h5>
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th  width="35%"><center>Nama Produk</center></th>
                                  <th  width="25%"><center>Stok</center></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                                while($row = mysqli_fetch_array($tbl60)){
                                  echo "<tr>";
                                  echo "<td><center>".$row['nama']."</center></td>";
                                  echo "<td><center>".$row['quantity']."</center></td>";
                                  echo "</tr>";
                                }
                              ?>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboardstok.js"></script> -->
</body>
</html>

<script type="text/javascript">
  document.getElementById("tabel1").style.display = "none";
  document.getElementById("tabel2").style.display = "none";
  document.getElementById("tabel3").style.display = "none";
  document.getElementById("teksdata10").style.display = "none";

  $(function dataChart(a) {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true
  var obj = [];

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($json_nama); ?>,
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: <?php echo json_encode($json_encode); ?>
          // data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})
</script>