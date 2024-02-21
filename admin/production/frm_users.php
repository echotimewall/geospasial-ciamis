<?php
	@ob_start();
	session_start();
	require '../../config.php';

    $no = $_GET['userid'];
	$sql = "select * from t_users where UserId=?";
	$row = $config->prepare($sql);
	$row -> execute(array($no));
	$jum = $row -> rowCount();
	if($jum > 0){
		$hasil = $row -> fetch();			

		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}

	if(isset($_POST['submit'])){
		$username = strip_tags($_POST['username']);
		$password = MD5(strip_tags($_POST['password']));
		$nama = strip_tags($_POST['nama']);
		$email = strip_tags($_POST['email']);
		$type = strip_tags($_POST['type']);
		$opd = strip_tags($_POST['opd']);
	
		$message = "Update data berhasil.";
		$sql = 'UPDATE t_users SET Username=?, Password=?, Name=?, Email=?, Type=?, OPD=? WHERE UserId='.$no;
		if ($no == '') {
			$message = "Insert data berhasil.";
			$sql = 'INSERT INTO t_users (Username, Password, Name, Email, Type, OPD) VALUES (?,?,?,?,?,?)';			
		}

		$row = $config->prepare($sql);
		$row -> execute(array($username, $password, $nama, $email, $type, $opd));
		
		echo '<script>alert("'.$message.'");window.location="users.php"</script>';
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

	<title>User | Database Pembangunan Wilayah Kabupaten Ciamis</title>

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
                <h3>&nbsp;</h3>
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
									<h2><small>Form </small>Pengguna Aplikasi</h2>
									
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="username" name="username" required="required" class="form-control" value=<?php echo $hasil['Username']; ?>>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" id="password" name="password" required="required" class="form-control " value='<?php echo $hasil['Password']; ?>'>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="nama" name="nama" class="form-control " value='<?php echo $hasil['Name']; ?>'>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="email" name="email" class="form-control " value='<?php echo $hasil['Email']; ?>'>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Type User <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<!--<input type="text" id="luas" name="luas" required="required" class="form-control " value=''>-->
                                                <select id="type" name="type" class="form-control">
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="User">User OPD</option>
                                                </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">OPD <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="opd" name="opd" required="required" class="form-control" value='<?php echo $hasil['OPD']; ?>'>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" name="submit" class="btn btn-success">Submit</button>
                                                <a href="users.php" class="btn btn-warning">Back</a>
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
					Copyright &copy; 2022 <a href="https://dpupr.cimahikota.go.id" target="_blank">Dinas Pekerjaan Umum dan Penataan Ruang Kota Cimahi</a>
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
