<?php
	@ob_start();
	session_start();
	require 'connections.php';

    $no = $_GET['id'];
	$sql = "select *, ST_X(geom) as x, ST_Y(geom) as y from public.rtlh where id=?";
	$row = $config->prepare($sql);
	$row -> execute(array($no));
	$jum = $row -> rowCount();
	if($jum > 0){
		$hasil = $row -> fetch();			

		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}

	if(isset($_POST['submit'])){
		//$dirUpload = "/dokumen/";

		$nama = strip_tags($_POST['nama']);
		$alamat = strip_tags($_POST['alamat']);
		$desa = strip_tags($_POST['desa']);
        $kecamatan = strip_tags($_POST['kecamatan']);
        $jk = strip_tags($_POST['jnskelamin']);
        $tahun = strip_tags($_POST['thnpenanga']);
        $dana = strip_tags($_POST['sumberdana']);
        $keterangan = strip_tags($_POST['keterangan']);
        $x = strip_tags($_POST['x']);
        $y = strip_tags($_POST['y']);

		//$file = strip_tags($_POST['shp']);
		//$status = "Diterima";

		//$namafile = basename($_FILES["shp"]["name"]);
		//$namaSementara = $_FILES['shp']['tmp_name'];
        //$terupload = move_uploaded_file($namaSementara, __DIR__.$dirUpload.$namafile); 
	
		//$sql = "INSERT INTO public.rtlh (nama, alamat, desa, kecamatan, jnskelamin, thnpenanga, sumberdana, keterangan, geom) VALUES (?,?,?,?,?,?,?,?,ST_GeomFromText('POINT(? ?)', 4326))";			
        $sql = "INSERT INTO public.rtlh(geom, nama, alamat, desa, kecamatan, jnskelamin, thnpenanga, sumberdana, keterangan) VALUES (ST_GeomFromText('POINT(".$x." ".$y.")', 4326), '".$nama."', 'GVR', 'A', 'B', 'Laki-Laki', '2023', '', 'Test')";
        echo "<script>alert(".$sql.");</script>";

		$row = $config->prepare($sql);
        $row->execute();
		//$row -> execute(array($nama, $alamat, $desa, $kecamatan, $jk, $tahun, $dana, $keterangan, $x, $y));
		
		if ($row > 0)
			echo '<script>alert("Data berhasil ditambahkan.");window.location="rtlh.php"</script>';
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

	<title>Form RTLH | Database Pembangunan Wilayah Kabupaten Ciamis</title>

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
					<?php include('sidebar.php'); ?>
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
									<h2><small>Form Data</small> Rumah Tidak Layak Huni</h2>
									
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="nama" name="nama" required="required" class="form-control" value="<?php echo $hasil['nama']; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="alamat" name="nama_ruas" required="alamat" class="form-control " value="<?php echo $hasil['alamat']; ?>">
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Desa <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="desa" name="desa" required="required" class="form-control" value="<?php echo $hasil['desa']; ?>">
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kecamatan <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="kecamatan" name="kecamatan" class="form-control " value="<?php echo $hasil['kecamatan']; ?>">
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jenis Kelamin
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="jk" name="jk" class="form-control " value='<?php echo $hasil['jnskelamin']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tahun Penanganan</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="tahun" name="tahun" required="required" class="form-control " value='<?php echo $hasil['thnpenanga']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Sumber Dana</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="dana" name="dana" class="form-control " value='<?php echo $hasil['sumberdana']; ?>'>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Keterangan</label>
											<div class="col-md-6 col-sm-6 ">
												<!--<input type="text" id="bentang" name="bentang" class="form-control " value=''>-->
                                                <textarea id="keterangan" name="keterangan" rows="5" class="form-control"><?php echo $hasil['keterangan']; ?></textarea>
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Koordinat <span class="required">*</span></label>
											<div class="col-md-3 col-sm-6 ">
												<input type="text" id="x" name="x" class="form-control " placeholder="Longitude" value='<?php echo $hasil['x']; ?>'>
                                            </div>
                                            <div class="col-md-3 col-sm-6 ">
                                                <input type="text" id="y" name="y" class="form-control " placeholder="Latitude" value='<?php echo $hasil['y']; ?>'>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <a href="rtlh.php" class="btn btn-warning">Back</a>
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
