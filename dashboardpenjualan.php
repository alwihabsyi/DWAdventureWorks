<?php 
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'dwadventure';

$connect = mysqli_connect($host, $user, $password, $db);
if(!$connect){
    die('koneksi db gagal'.mysqli_error($connect));
}

//QUANTITY START
$totalqty2002 = 0;
$totalqty2003 = 0;

$query1 = "SELECT MONTH(t.tanggalLengkap) AS bulan,
SUM(f.qty) AS quantity
FROM faktapenjualan f
join tanggal t on f.idTanggal = t.idTanggal
where t.tahun = '2002'
GROUP BY MONTH(t.tanggalLengkap)
ORDER BY MONTH(t.tanggalLengkap)";

$fetch = mysqli_query($connect, $query1);
while($row = mysqli_fetch_array($fetch)){
  $data[] = $row['quantity'];
  $bulan[] = $row['bulan'];
  $totalqty2002 += $row['quantity'];
}

$json_query1 = $data;
$json_bulan1 = $bulan;

$query2 = "SELECT MONTH(t.tanggalLengkap) AS bulan,
SUM(f.qty) AS quantity
FROM faktapenjualan f
join tanggal t on f.idTanggal = t.idTanggal
where t.tahun = '2003'
GROUP BY MONTH(t.tanggalLengkap)
ORDER BY MONTH(t.tanggalLengkap)";

$fetch2 = mysqli_query($connect, $query2);
while($row = mysqli_fetch_array($fetch2)){
  $data2[] = $row['quantity'];
  $bulan2[] = $row['bulan'];
  $totalqty2003 += $row['quantity'];
}

$json_query2 = $data2;
$json_bulan2 = $bulan2;

//QUANTITY END

$pendapatan2002 = 0;
$pendapatan2003 = 0;

$query2002 = "SELECT MONTH(t.tanggalLengkap) AS bulan,
ROUND(SUM(f.subTotal)) AS pendapatan
FROM faktapenjualan f
join tanggal t on f.idTanggal = t.idTanggal
where t.tahun = '2002'
GROUP BY MONTH(t.tanggalLengkap)
ORDER BY MONTH(t.tanggalLengkap)";

$fetch2002 = mysqli_query($connect, $query2002);
while($row = mysqli_fetch_array($fetch2002)){
  $data2002[] = $row['pendapatan'];
  $bulan2002[] = $row['bulan'];
  $pendapatan2002 += $row['pendapatan'];
}

$json_query2002 = $data2002;
$json_bulan2002 = $bulan2002;

$query2003 = "SELECT MONTH(t.tanggalLengkap) AS bulan,
ROUND(SUM(f.subTotal)) AS pendapatan
FROM faktapenjualan f
join tanggal t on f.idTanggal = t.idTanggal
where t.tahun = '2003'
GROUP BY MONTH(t.tanggalLengkap)
ORDER BY MONTH(t.tanggalLengkap)";

$fetch2003 = mysqli_query($connect, $query2003);
while($row = mysqli_fetch_array($fetch2003)){
  $data2003[] = $row['pendapatan'];
  $bulan2003[] = $row['bulan'];
  $pendapatan2003 += $row['pendapatan'];
}

$json_query2003 = $data2003;
$json_bulan2003 = $bulan2003;

// query top 10 produk
$querytop10 = "select nama, sum(qty) as Terjual from produk p 
join faktaPenjualan fp
on p.idProduk = fp.idProduk
join tanggal t
on t.idTanggal = fp.idTanggal 
where year(t.tanggalLengkap)='2003'
group by fp.idProduk, nama order by terjual desc limit 10";
$top10 = mysqli_query($connect, $querytop10);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DWOBOSZZH | Dashboard Penjualan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- link bootstrap -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    .tabeltop10{
      margin: 0 auto;
    }
    .h3tp{
      text-align : center;
    }
  </style>
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
                <a href="dashboardpenjualan.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="dashboardstok.php" class="nav-link">
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
            <h1 class="m-0"><b>Dashboard Penjualan</b></h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="column">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h4 class=""><b>Grafik Jumlah Produk Terjual</b></h4>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-between">
                      <div class="d-flex flex-column mr-4">
                        <span class="text-primary">Total Produk Terjual 2002</span>
                        <span class="text-bold text-lg mb-4 text-primary"><?php echo $totalqty2002?> Unit</span>
                      </div>
                      
                      <div class="d-flex flex-column">
                        <span>Total Produk Terjual 2003</span>
                        <span class="text-bold text-lg mb-4 text-secondary"><?php echo $totalqty2003?> Unit</span>
                      </div>
                    </div>
                  </p>
                </div>
                <!-- /.d-flex -->

                <span>Unit</span>
                <div class="position-relative mt-2 mb-4">
                  <canvas id="visitors-chart" height="300"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> 2002
                  </span>

                  <span>
                    <i class="fas fa-square text-secondary"></i> 2003
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h4 class=""><b>Grafik Penjualan</b></h4>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-between">
                      <div class="d-flex flex-column mr-4">
                        <span class="text-primary">Total Pendapatan 2002</span>
                        <span class="text-bold text-lg mb-4 text-primary">$ <?php echo $pendapatan2002?></span>
                      </div>
                      
                      <div class="d-flex flex-column">
                        <span>Total Pendapatan 2003</span>
                        <span class="text-bold text-lg mb-4 text-secondary">$ <?php echo $pendapatan2003?></span>
                      </div>
                    </div>
                  </p>
                </div>
                <span>Pendapatan</span>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="400"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> 2002
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> 2003
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <p class="highcharts-description">
                  Pie Chart dapat diklik di setiap bagian untuk menampilkan data yang lebih detail.
                </p>
              </div>
              <figure class="highcharts-figure">
                  <div id="container"></div>
              </figure>
            </div>
          </div>

          <!-- /.col-md-6 -->
          <div class="col-md-6 tabeltop10">
          <div class="card">
            <div class="card-body">
              <h3 class="m-0 mb-4 h3tp"><b>Top Produk 2003</b></h3>
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th  width="35%"><center>Nama Produk</center></th>
                              <th  width="25%"><center>Jumlah Terjual</center></th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                            while($row = mysqli_fetch_array($top10)){
                              echo "<tr>";
                              echo "<td><center>".$row['nama']."</center></td>";
                              echo "<td><center>".$row['Terjual']."</center></td>";
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
<!-- Pie Chart Script -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboardpenjualan.js"></script> -->
</body>
</html>

<!-- Start Chart -->
<script type="text/javascript">
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Data Produk Terjual. 2003'
    },
    subtitle: {
        text: 'Klik salah satu bagian dari diagram pie untuk melihat detail penjualan.'
    },

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: '%'
        }
    },

    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Bulan",
            colorByPoint: true,
            data: 
            [
                {
                    name: "Januari",
                    y: 2.83,
                    drilldown: "Januari"
                },
                {
                    name: "Februari",
                    y: 4.36,
                    drilldown: "Februari"
                },
                {
                    name: "Maret",
                    y: 3.31,
                    drilldown: "Maret"
                },
                {
                    name: "April",
                    y: 4.57,
                    drilldown: "April"
                },
                {
                    name: "Mei",
                    y: 6.64,
                    drilldown: "Mei"
                },
                {
                    name: "Juni",
                    y: 5.17,
                    drilldown: "Juni"
                },
                {
                    name: "Juli",
                    y: 9.05,
                    drilldown: "Juli"
                },
                {
                    name: "Agustus",
                    y: 15.23,
                    drilldown: "Agustus"
                },
                {
                    name: "September",
                    y: 14.98,
                    drilldown: "September"
                },
                {
                    name: "Oktober",
                    y: 9.31,
                    drilldown: "Oktober"
                },
                {
                    name: "November",
                    y: 11.85,
                    drilldown: "November"
                },
                {
                    name: "Desember",
                    y: 12.71,
                    drilldown: "Desember"
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Januari",
                id: "Januari",
                data: [
                    [
                        "Minggu Ke-1",
                        95.68
                    ],
                    [
                        "Minggu Ke-2",
                        1.60
                    ],
                    [
                        "Minggu Ke-3",
                        1.32
                    ],
                    [
                        "Minggu Ke-4",
                        1.40
                    ]
                ]
            },
            {
                name: "Februari",
                id: "Februari",
                data: [
                    [
                        "Minggu Ke-1",
                        96.71
                    ],
                    [
                        "Minggu Ke-2",
                        1.00
                    ],
                    [
                        "Minggu Ke-3",
                        1.13
                    ],
                    [
                        "Minggu Ke-4",
                        1.16
                    ]
                ]
            },
            {
                name: "Maret",
                id: "Maret",
                data: [
                    [
                        "Minggu Ke-1",
                        96.25
                    ],
                    [
                        "Minggu Ke-2",
                        1.42
                    ],
                    [
                        "Minggu Ke-3",
                        1.40
                    ],
                    [
                        "Minggu Ke-4",
                        0.93
                    ]
                ]
            },
            {
                name: "April",
                id: "April",
                data: [
                    [
                        "Minggu Ke-1",
                        96.80
                    ],
                    [
                        "Minggu Ke-2",
                        1.19
                    ],
                    [
                        "Minggu Ke-3",
                        1.03
                    ],
                    [
                        "Minggu Ke-4",
                        0.99
                    ]
                ]
            },
            {
                name: "Mei",
                id: "Mei",
                data: [
                    [
                        "Minggu Ke-1",
                        97.85
                    ],
                    [
                        "Minggu Ke-2",
                        0.77
                    ],
                    [
                        "Minggu Ke-3",
                        0.56
                    ],
                    [
                        "Minggu Ke-4",
                        0.82
                    ]
                ]
            },
            {
                name: "Juni",
                id: "Juni",
                data: [
                    [
                        "Minggu Ke-1",
                        96.97
                    ],
                    [
                        "Minggu Ke-2",
                        1.08
                    ],
                    [
                        "Minggu Ke-3",
                        1.00
                    ],
                    [
                        "Minggu Ke-4",
                        0.95
                    ]
                ]
            },
            {
                name: "Juli",
                id: "Juli",
                data: [
                    [
                        "Minggu Ke-1",
                        92.42
                    ],
                    [
                        "Minggu Ke-2",
                        2.63
                    ],
                    [
                        "Minggu Ke-3",
                        2.19
                    ],
                    [
                        "Minggu Ke-4",
                        2.76
                    ]
                ]
            },
            {
                name: "Agustus",
                id: "Agustus",
                data: [
                    [
                        "Minggu Ke-1",
                        87.68
                    ],
                    [
                        "Minggu Ke-2",
                        4.30
                    ],
                    [
                        "Minggu Ke-3",
                        4.22
                    ],
                    [
                        "Minggu Ke-4",
                        3.80
                    ]
                ]
            },
            {
                name: "September",
                id: "September",
                data: [
                    [
                        "Minggu Ke-1",
                        86.52
                    ],
                    [
                        "Minggu Ke-2",
                        4.61
                    ],
                    [
                        "Minggu Ke-3",
                        4.64
                    ],
                    [
                        "Minggu Ke-4",
                        4.23
                    ]
                ]
            },
            {
                name: "Oktober",
                id: "Oktober",
                data: [
                    [
                        "Minggu Ke-1",
                        77.95
                    ],
                    [
                        "Minggu Ke-2",
                        7.64
                    ],
                    [
                        "Minggu Ke-3",
                        7.09
                    ],
                    [
                        "Minggu Ke-4",
                        7.33
                    ]
                ]
            },
            {
                name: "November",
                id: "November",
                data: [
                    [
                        "Minggu Ke-1",
                        82.55
                    ],
                    [
                        "Minggu Ke-2",
                        5.21
                    ],
                    [
                        "Minggu Ke-3",
                        6.33
                    ],
                    [
                        "Minggu Ke-4",
                        5.91
                    ]
                ]
            },
            {
                name: "Desember",
                id: "Desember",
                data: [
                    [
                        "Minggu Ke-1",
                        80.19
                    ],
                    [
                        "Minggu Ke-2",
                        6.70
                    ],
                    [
                        "Minggu Ke-3",
                        6.79
                    ],
                    [
                        "Minggu Ke-4",
                        6.32
                    ]
                ]
            }
        ]
    }
});
</script>

<script type="text/javascript">
  $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: <?php echo json_encode($json_query2002); ?>
        },
        {
          backgroundColor: '#6c757d',
          borderColor: '#ced4da',
          data: <?php echo json_encode($json_query2003); ?>
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
              if (value >= 12000) {
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
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [{
        type: 'line',
        data: <?php echo json_encode($json_query1); ?>,
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
        data: <?php echo json_encode($json_query2); ?>,
        backgroundColor: 'tansparent',
        borderColor: '#6c757d',
        pointBorderColor: '#6c757d',
        pointBackgroundColor: '#6c757d',
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