<?php
	@ob_start();
	session_start();
	require '../../config.php';

    $no = $_GET['id'];
	/*$sql = "select * from t_siteplan where no_rencana=?";
	$row = $config->prepare($sql);
	$row -> execute(array($no));
	$jum = $row -> rowCount();
	if($jum > 0){
		$hasil = $row -> fetch();			

		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}

	if(isset($_POST['submit'])){
		$no_rencana = strip_tags($_POST['no_rencana']);
		$pemohon = strip_tags($_POST['pemohon']);
		$tahun = strip_tags($_POST['tahun']);
		$peruntukan = strip_tags($_POST['peruntukan']);
		$pemanfaatan = strip_tags($_POST['pemanfaatan']);
		$luas = strip_tags($_POST['luas']);
		$koordinat = strip_tags($_POST['koordinat']);
	
		$sql = 'UPDATE t_siteplan SET pemohon=?, tahun=?, peruntukan=?, pemanfaatan=?, luas=?, koordinat=? WHERE no_rencana=?';
		if ($no == '')
			$sql = 'INSERT INTO t_siteplan (pemohon, tahun, peruntukan, pemanfaatan, luas, koordinat, no_rencana) VALUES (?,?,?,?,?,?,?)';			

		$row = $config->prepare($sql);
		$row -> execute(array($pemohon, $tahun, $peruntukan, $pemanfaatan, $luas, $koordinat, $no_rencana));
		
		echo '<script>alert("Update data berhasil.");window.location="dokumen.php"</script>';
	}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/bekasi.png" type="image/ico" />

	<title>Si-CANDRA Kota Bekasi</title>

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
					<div class="navbar nav_title" style="border: 0;">
					<a href="../../index.php" class="site_title"><img src="images/bekasi.png" width="45px" height="45px"> <span>SI-CANDRA</span></a>
					</div>

					<div class="clearfix"></div>					

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a href="index.php"><i class="fa fa-home"></i> Dashboard </a></li>
								<li><a href="users.php"><i class="fa fa-user"></i> Pengguna Aplikasi </a></li>
								<li><a><i class="fa fa-pencil-square-o"></i> Data Referensi <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									    <li><a href="about.php">Tentang Si-CANDRA</a></li>
									    <li><a href="dokumen.php">Dokumen</a></li>
									    <li><a href="galeri.php">Galeri</a></li>
                                        <li><a href="galeri.php">Kontak</a></li>
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
									<h2><small>Form </small>Galeri</h2>
									
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Judul <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="judul" name="judul" required="required" class="form-control" value=''>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Subjudul <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="subjudul" name="subjudul" required="required" class="form-control" value=''>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Image File <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<!--<input type="text" id="tahun" name="tahun" required="required" class="form-control " value=''>-->
                                                <input type="file" id="imgUpload" name="imgUpload" class="form-control">
											</div>
										</div>                                        
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" name="submit" class="btn btn-success">Submit</button>
                                                <a href="galeri.php" class="btn btn-warning">Back</a>
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
					Copyright &copy; 2022 <a href="https://bekasikota.go.id" target="_blank">Dinas Tata Ruang Kota Bekasi</a>
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
