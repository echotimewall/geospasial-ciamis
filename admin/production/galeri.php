<?php
  session_start();
  $url = gethostname();
  $parse = parse_url($url);
  $host = $parse['host'].'/si-candra';//"http://localhost/si-candra";
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
    
    <!-- Custom styling plus plugins -->
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
                <h3>&nbsp;</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Dashboard </a></li>
                  <li><a href="users.php"><i class="fa fa-user"></i> Pengguna Aplikasi </a></li>
                  <li><a><i class="fa fa-pencil-square-o"></i> Data Referensi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="about.php">Tentang Si-CANDRA</a></li>
                      <li><a href="dokumen.php">Siteplan</a></li>
                      <li><a href="galeri.php">Galeri</a></li>
                      <li><a href="kontak.php">Kontak</a></li>
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
                      <a class="dropdown-item"  href="javascript:;"> Profile</a>
                      <a class="dropdown-item"  href="../../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Daftar </small> Galeri/Album</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/1.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Bina Nusantara Raya</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/1.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=1"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p>Perum Beranda Mas Asri</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/2.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Futura Propertindo</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/2.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=2"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p>Perum De Green Bekasi</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/3.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Timah Pond 3</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/3.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=3"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p>Polder PT. Timah Pond</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/4.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Qodau Sukses Properindo</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/4.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=4"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p>Perumahan Premier Estate 2</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/5.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Qada Sukses Properindo</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/5.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=5"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p>Perumahan Premier Estate 2</p>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/6.jpg" alt="image" />
                            <div class="mask">
                              <p>Perumahan Arccelli 2 Residence</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/6.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=6"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <!--<p><strong>Image Name</strong></p>-->
                            <p>Perumahan Arccelli 2 Residence</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/7.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Adhi Persada</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/7.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=7"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <!--<p><strong>Image Name</strong></p>-->
                            <p>Saluran Tertutup</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/8.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Bina Nusantara</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/8.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=8"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <!--<p><strong>Image Name</strong></p>-->
                            <p>Saluran Terbuka</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="../../images/teachers/9.jpg" alt="image" />
                            <div class="mask">
                              <p>PT. Sinar Jaya Nusantara Putra</p>
                              <div class="tools tools-bottom">
                                <a href="<?php echo $host ?>/images/teachers/9.jpg" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="frm_galeri.php?id=9"><i class="fa fa-pencil"></i></a>                                
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <!--<p><strong>Image Name</strong></p>-->
                            <p>Pergudangan</p>
                          </div>
                        </div>
                      </div>
                      <!--<div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                            <div class="mask no-caption">
                              <div class="tools tools-bottom">
                                <a href="#"><i class="fa fa-link"></i></a>
                                <a href="#"><i class="fa fa-pencil"></i></a>
                                <a href="#"><i class="fa fa-times"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p><strong>Image Name</strong>
                            </p>
                            <p>Snow and Ice Incoming</p>
                          </div>
                        </div>
                      </div>-->
                    </div>
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
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>