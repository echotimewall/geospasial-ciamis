<?php
@ob_start();
session_start();
if(isset($_POST['submit'])){
    require '../config.php';
        
    $user = strip_tags($_POST['username']);
    $pass = strip_tags($_POST['pass']);

    $sql = 'select *
            from t_users
            where Username =? and Password = md5(?)';
    //echo $sql;
    $row = $config->prepare($sql);
    $row -> execute(array($user,$pass));
    $jum = $row -> rowCount();
    if($jum > 0){
        $hasil = $row -> fetch();
        $_SESSION['admin'] = $hasil;
        echo '<script>alert("Login Sukses");window.location="production/index.php"</script>';
    }else{
        echo '<script>alert("Login gagal. Username atau password tidak sesuai !");history.go(-1);</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta name="description" content="Database Pembangunan Daerah Kabupaten Ciamis">
  <meta name="author" content="nono dwi antoro">
  <link rel="icon" href="../assets/img/ciamis.png">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  

  <title>Login | Database Pembangunan Daerah Kabupaten Ciamis</title>

  <!--<link rel="stylesheet" href="https://esri.github.io/calcite-maps/dist/css/calcite-maps-bootstrap.min-v0.10.css">
  <link rel="stylesheet" href="https://esri.github.io/calcite-maps/dist/css/calcite-maps-arcgis-4.x.min-v0.10.css">
  <link rel="stylesheet" href="https://js.arcgis.com/4.22/esri/css/main.css">-->
  <link rel="stylesheet" href="build/css/login.css">

</head>
<body>
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row">
							<a href="index.php"><img src="../assets/img/ciamis.png" class="logo"><img src="../assets/img/bappeda.png" width="135px" height="45px" style="margin-top: 20px;"></a>
							<!--<h6 style="margin-top: 20px; margin-left: 10px; font-weight: bold;">BADAN PERENCANAAN PEMBANGUNAN DAERAH<br />KABUPATEN CIAMIS</h6>-->
                    </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                        <img src="https://i.imgur.com/uNGdWHi.png" class="image">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            	<form name="frmLogin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3">
                        <h6 class="mb-0 mr-4 mt-2"><b>Sign in</b></h6>
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Username</h6></label>
                        <input class="mb-4" type="text" name="username" placeholder="Enter a valid username">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                        <input type="password" name="pass" placeholder="Enter password">
                    </div>
                    <div class="row px-3 mb-4">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> 
                            <label for="chk1" class="custom-control-label text-sm">Remember me</label>
                        </div>
                        <a href="#" class="ml-auto mb-0 text-sm">Lupa password ?</a>
                    </div>
                    <div class="row mb-3 px-3">
                        <button type="submit" name="submit" class="btn btn-blue text-center">Login</button>
                    </div>
                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold"><a href="index.php" class="text-danger ">Kembali kehalaman depan</a></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3">
                <small class="ml-4 ml-sm-5 mb-2"><script>document.write(new Date().getFullYear());</script> &copy; Badan Perencanaan Pembangunan Daerah Kabupaten Ciamis</small>
            </div>
        </div>
    </div>
</div>
</body>
</html>