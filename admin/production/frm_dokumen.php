<?php
	@ob_start();
	session_start();
	require '../../config.php';

    $no = $_GET['id'];
	$sql = "select * from t_jembatan where no_jembatan=?";
	$row = $config->prepare($sql);
	$row -> execute(array($no));
	$jum = $row -> rowCount();
	if($jum > 0){
		$hasil = $row -> fetch();			

		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}

	if(isset($_POST['submit'])){
		$dirUpload = "/dokumen/";

		$nama = strip_tags($_POST['nama']);
		$opd = strip_tags($_POST['opd']);
		$tahun = strip_tags($_POST['tahun']);
		//$file = strip_tags($_POST['shp']);
		$status = "Diterima";

		$namafile = basename($_FILES["shp"]["name"]);
		$namaSementara = $_FILES['shp']['tmp_name'];
        $terupload = move_uploaded_file($namaSementara, __DIR__.$dirUpload.$namafile); 
	
		$sql = 'INSERT INTO t_tematik (nama, tahun, opd, status, namafile) VALUES (?,?,?,?,?)';			

		$row = $config->prepare($sql);
		$row -> execute(array($nama, $tahun, $opd, $status, $namafile));
		
		if ($row > 0)
			echo '<script>alert("Data berhasil ditambahkan.");window.location="dokumen.php"</script>';
		else
		echo '<script>alert("Penambahan data gagal !");</script>';
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/ciamis.png" type="image/ico" />

	<title>Si-TARUNG Kota Cimahi</title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
	<link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
	<!-- Select2 -->
	<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!-- Switchery -->
	<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- starrr -->
	<link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title text-center" style="border: 0;">
              <a href="../../index.php" class="site_title"><img src="images/ciamis.png" width="35px" height="45px"> BAPPEDA<span></span></a>
          </div>

					<div class="clearfix"></div>					

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<ul class="nav side-menu">
								<li><a href="index.php"><i class="fa fa-home"></i> Dashboard </a></li>
								<li><a href="users.php"><i class="fa fa-user"></i> Pengguna Aplikasi </a></li>
								<li><a><i class="fa fa-pencil-square-o"></i> Informasi Data <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									    <li><a href="dokumen.php">Data Jembatan</a></li>
									    <li><a href="air.php">Data Air Minum</a></li>
									    <li><a href="pengaduan.php">Data Pengaduan</a></li>
									</ul>
								</li>
							</ul>
						</div>						
					</div>
					<!-- /sidebar menu -->					
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="images/img.jpg" alt=""><?php echo $_SESSION['admin']['Name']; ?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="javascript:;"> Profile</a>
									<a class="dropdown-item" href="../../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>							
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2><small>Form Data</small> Jembatan</h2>
									
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No Ruas <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="no_ruas" name="no_ruas" required="required" class="form-control" value='<?php echo $hasil['no_ruas']; ?>'>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Ruas <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="nama_ruas" name="nama_ruas" required="required" class="form-control " value='<?php echo $hasil['nama_ruas']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No Jembatan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="no_jembatan" name="no_jembatan" required="required" class="form-control" value='<?php echo $hasil['no_jembatan']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Jembatan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="nama" name="nama" class="form-control " value='<?php echo $hasil['nama']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">KM POS
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="kmpos" name="kmpos" class="form-control " value='<?php echo $hasil['kmpos']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Panjang</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="panjang" name="panjang" required="required" class="form-control " value='<?php echo $hasil['panjang']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Lebar</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="lebar" name="lebar" class="form-control " value='<?php echo $hasil['lebar']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah Bentang</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="bentang" name="bentang" class="form-control " value='<?php echo $hasil['bentang']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipe Bangunan Atas</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="tipe_ba" name="tipe_ba" class="form-control " value='<?php echo $hasil['tipe_ba']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kondisi Bangunan Atas</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="kondisi_ba" name="kondisi_ba" class="form-control " value='<?php echo $hasil['kondisi_ba']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipe Bangunan Bawah</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="tipe_bb" name="tipe_bb" class="form-control " value='<?php echo $hasil['tipe_bb']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kondisi Bangunan Bawah</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="kondisi_bb" name="kondisi_bb" class="form-control " value='<?php echo $hasil['kondisi_bb']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipe Fondasi</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="tipe_fondasi" name="tipe_fondasi" class="form-control " value='<?php echo $hasil['tipe_fondasi']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kondisi Fondasi</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="kondisi_fondasi" name="kondisi_fondasi" class="form-control " value='<?php echo $hasil['kondisi_fondasi']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipe Lantai</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="tipe_lantai" name="tipe_lantai" class="form-control " value='<?php echo $hasil['tipe_lantai']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kondisi Lantai</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="kondisi_lantai" name="kondisi_lantai" class="form-control " value='<?php echo $hasil['kondisi_lantai']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NK Jembatan</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="nk" name="nk" class="form-control " value='<?php echo $hasil['nk_jembatan']; ?>'>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <a href="dokumen.php" class="btn btn-warning">Back</a>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					<script>document.write(new Date().getFullYear());</script> &copy; Badan Perencanaan Pembangunan Daerah Kabupaten Ciamis
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="../vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="../vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="../vendors/moment/min/moment.min.js"></script>
	<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="../vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="../vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="../vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="../vendors/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

</body></html>
