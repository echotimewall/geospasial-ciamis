<?php
  @ob_start();
  session_start();
  require 'config.php';

  $no = $_GET['no_jembatan'];
  $sql = "select * from t_jembatan where no_jembatan=?";
  $row = $config->prepare($sql);
  $row -> execute(array($no));
  $jum = $row -> rowCount();
  if($jum > 0){
    $hasil = $row -> fetch();     

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pengaduan | Database Pembangunan Wilayah Kabupaten Ciamis</title>
  <meta content="Database Pembangunan Wilayah Kabupaten Ciamis" name="description">
  <meta content="BAPPEDA" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/ciamis.png" rel="icon">
  <link href="assets/img/ciamis.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>

  <!-- =======================================================
  * Template Name: Tempo - v4.9.0
  * Template URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">

    <a href="#" class="logo"><img src="assets/img/ciamis.png" alt="" class="img-fluid">
    <img src="assets/img/bappeda.png" alt="" class="img-fluid"></a>
      <!--<span class="title">BADAN PERENCANAAN PEMBANGUNAN DAERAH<br />KABUPATEN CIAMIS</span>-->

    <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">Tentang</a></li>
          <li class="dropdown"><a href="#"><span>Data</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="map.php" target="_blank">Spatial</a></li>
              <li class="dropdown"><a href="#"><span>Non Spatial</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="table.php">Jembatan</a></li>
                  <li><a href="air.php">Air Minum</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="form_pengaduan.php">Pengaduan</a></li>
          <li><a class="nav-link scrollto" href="index.php#contact">Kontak</a></li>          

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
          <br />
        <ol>
          <li><a href="index.php#hero">Beranda</a></li>
          <li>Table Data</li>
        </ol>
        <h2>Data Non Spatial - Jembatan</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">

        <div class="container">

        <div class="row">

          <div class="col-md-4">
            <img src="admin/production/images/jembatan/no image.png" width="80%" height="50%">
          </div>

          <div class="col-md-8">

            <table id="tblData" class="table table-striped table-bordered" style="width:100%">
              <tr><td>No Jembatan</td><td><?php echo $hasil['no_jembatan']; ?></td></tr>
              <tr><td>Nama Jembatan</td><td><?php echo $hasil['nama']; ?></td></tr>
              <tr><td>No Ruas</td><td><?php echo $hasil['no_ruas']; ?></td></tr>
              <tr><td>Nama Ruas</td><td><?php echo $hasil['nama_ruas']; ?></td></tr>
              <tr><td>KMPOS</td><td><?php echo $hasil['kmpos']; ?></td></tr>
              <tr><td>Panjang</td><td><?php echo $hasil['panjang']; ?></td></tr>
              <tr><td>Lebar</td><td><?php echo $hasil['lebar']; ?></td></tr>
              <tr><td>Jumlah Bentang</td><td><?php echo $hasil['bentang']; ?></td></tr>
              <tr><td>Tipe Bangunan Atas</td><td><?php echo $hasil['tipe_bb']; ?></td></tr>
              <tr><td>Kondisi Bangunan Atas</td><td><?php echo $hasil['kondisi_bb']; ?></td></tr>
              <tr><td>Tipe Bangunan Bawah</td><td><?php echo $hasil['tipe_ba']; ?></td></tr>
              <tr><td>Kondisi Bangunan Bawah</td><td><?php echo $hasil['kondisi_ba']; ?></td></tr>
              <tr><td>Tipe Fondasi</td><td><?php echo $hasil['tipe_fondasi']; ?></td></tr>
              <tr><td>Kondisi Fondasi</td><td><?php echo $hasil['kondisi_fondasi']; ?></td></tr>
              <tr><td>Tipe Lantai</td><td><?php echo $hasil['tipe_lantai']; ?></td></tr>
              <tr><td>Kondisi Lantai</td><td><?php echo $hasil['kondisi_lantai']; ?></td></tr>
              <tr><td>NK Jembatan</td><td><?php echo $hasil['nk_jembatan']; ?></td></tr>
            </table>
          </div>
        </div>

        </div>

        <br /><br />

    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-contact">
            <h3 style="color:#444444">BAPPEDA</h3>
            <p>
              Badan Perencanaan Pembangunan Daerah Kabupaten Ciamis<br> Jl. Stasiun No.18, Ciamis Kecamatan Ciamis Kabupaten Ciamis, Jawa Barat<br>
              <strong>Telp:</strong> (0265) 771109/771693<br>
              <strong>Website:</strong> https://bappeda.ciamiskab.go.id<br>
            </p>
          </div>

          <div class="col-lg-6 col-md-6 footer-newsletter">
            <h4>Link Terkait</h4>
            <ul>
              <li> <a href="https://ciamiskab.go.id" target="_blank">Kabupaten Ciamis</a></li>
              <li> <a href="https://bappeda.ciamiskab.go.id" target="_blank">Badan Perencanaan Pembangunan Daerah</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          <script>document.write(new Date().getFullYear());</script> &copy; Copyright Badan Perencanaan Pembangunan Daerah Kabupaten Ciamis
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>  
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</body>

</html>