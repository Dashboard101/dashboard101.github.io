<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>



  <div class="pagetitle py-5 px-5">


    <section class="section dashboard">
      <div class="row">


        <div class="col-lg-12">
          <div class="row">
          <?php
// Fungsi untuk menghitung jumlah qty
function countQty($connect, $period) {
    switch ($period) {
        case 'this day':
            $query = "SELECT SUM(qty) AS total_qty FROM data WHERE DATE(time) = CURDATE()";
            break;
        case 'this month':
            $query = "SELECT SUM(qty) AS total_qty FROM data WHERE MONTH(time) = MONTH(CURDATE()) AND YEAR(time) = YEAR(CURDATE())";
            break;
        case 'all':
            $query = "SELECT SUM(qty) AS total_qty FROM data";
            break;
        default:
            return 0; // Jika periode tidak valid, kembalikan 0
    }
    
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_qty'];
}

// Penggunaan fungsi untuk menghitung jumlah qty
$qty_today = countQty($connect, 'this day');
$qty_this_month = countQty($connect, 'this month');
$qty_all = countQty($connect, 'all');

?>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

               

                <div class="card-body">
                  <h5 class="card-title">Masuk <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-brightness-high"></i> 

                    </div>
                    <div class="ps-3">
                      <h6><?php echo $qty_today ?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

               

                <div class="card-body">
                  <h5 class="card-title">Masuk <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-calendar2-month"></i>

                    </div>
                    <div class="ps-3">
                    <h6><?php echo $qty_this_month ?></h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Masuk <span>| All</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-grid"></i>

                    </div>
                    <div class="ps-3">
                    <h6><?php echo $qty_all ?></h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
  <div class="card">

    <div class="filter">
      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
          <h6>Filter</h6>
        </li>

        <li><a class="dropdown-item" href="?filter=today">Today</a></li>
        <li><a class="dropdown-item" href="?filter=this_month">This Month</a></li>
        <li><a class="dropdown-item" href="?filter=all">All</a></li>
      </ul>
    </div>

    <?php
// Mengambil data untuk hari ini dari database
$query = "SELECT time, qty FROM data WHERE DATE(time) = CURDATE()";
$result = mysqli_query($connect, $query);

$series_sales = [];
$categories = [];

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row['time']; // Mengambil waktu sebagai kategori
    $series_sales[] = $row['qty']; // Mengambil qty sebagai data penjualan
}
?>

<div class="card-body">
    <h5 class="card-title">Reports <span>
        <?php
        if (isset($_GET['filter'])) {
            switch ($_GET['filter']) {
                case 'today':
                    echo "/ Today";
                    break;
                case 'this_month':
                    echo "/ This Month";
                    break;
                case 'all':
                    echo "/ All";
                    break;
                default:
                    echo "/ Today";
                    break;
            }
        } else {
            echo "/ Today";
        }
        ?>
    </span></h5>

    <!-- Line Chart -->
    <div id="reportsChart"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsChart"), {
                series: [{
                    name: 'Sales',
                    data: <?php echo json_encode($series_sales); ?>
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'datetime',
                    categories: <?php echo json_encode($categories); ?>
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                }
            }).render();
        });
    </script>
    <!-- End Line Chart -->

</div>
  </div>
<!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Data <span>| Masuk</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM data";
                      $result = mysqli_query($connect, $query);

                      while ($row = mysqli_fetch_array($result)) {
                      ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $row["id"]; ?></a></th>
                          <td><?php echo date("d-m-Y", strtotime($row["time"])); ?></td>
                          <td><a href="#" class="text-primary"><?php echo date("H:i:s", strtotime($row["time"])); ?></a></td>
                          <td><?php echo $row["qty"]; ?></td>

                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->



          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->


      </div>
    </section>

    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>