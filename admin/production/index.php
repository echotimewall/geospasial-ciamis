<?php
    session_start();

    if (empty($_SESSION['admin'])) {
      header('Location: /index.php');
      exit();
    }
    
    $iri_nanggela = '20.963,30';
    $iri_dankir = '15.889,98';
    $bgn_nanggela = '209';
    $bgn_dankir = '177';

    $primer_nanggela = '7.354,10';
    $primer_dankir = '8.258,39';
    $sekunder_nanggela = '13.609,20';
    $sekunder_dankir = '7.631,59';

    $sbeton_nanggela = '4.852,24';
    $sbatu_nanggela = '4.729,29';
    $stanah_nanggela = '11.381,77';

    $sbeton_dankir = '2.983,68';
    $sbatu_dankir = '4.901,55';
    $stanah_dankir = '8.004,75';

    $sbaik_nanggela = '5.957,70';
    $ssedang_nanggela = '12.960,11';
    $sburuk_nanggela = '2.045,49';

    $sbaik_dankir = '2.441,99';
    $ssedang_dankir = '9.407,29';
    $sburuk_dankir = '4.040,70';

    $beton_nanggela = '33';
    $batu_nanggela = '172';
    $tanah_nanggela = '2';
    $bata_nanggela = '2';

    $beton_dankir = '92';
    $batu_dankir = '63';
    $tanah_dankir = '21';
    $bata_dankir = '1';

    $baik_nanggela = '107';
    $sedang_nanggela = '80';
    $buruk_nanggela = '22';

    $baik_dankir = '30';
    $sedang_dankir = '63';
    $buruk_dankir = '84';
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

    <title>Dashboard | Database Pembangunan Wilayah Kabupaten Ciamis</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
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

            <!-- menu profile quick info -->
            <!--<div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Administrator</h2>
              </div>
            </div>-->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php include('sidebar.php'); ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--<div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>-->
            <!-- /menu footer buttons -->
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
                    <img src="images/img.jpg" alt="">Administrator
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profil</a>
                    <a class="dropdown-item"  href="../../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <!--<li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>-->
              </ul>
            </nav>
          </div>
        </div>        
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-8">
                    <h3><small>Selamat datang di halaman Administrator </small>Geospatial<small> Ciamis</small></h3>
                  </div>
                  <div class="col-md-4 text-right">
                    
                    <div class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <span><?php echo date("l, d M Y"); ?></span>  
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12">
                  <!--<iframe src="../../map.php" width="100%" height="650px"></iframe>-->        
                </div>
              </div>
            </div>

          </div>

          <!--<div class="">-->
          <div class="row">
            <!--<div class="top_tiles">-->
              <div class="col-lg-3 col-md-6">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-code-fork"></i></div>
                  <div class="count"><?php echo $iri_nanggela; ?> m</div>
                  <h3>D.I Nanggela</h3>
                  <p>Saluran Irigasi</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-code-fork"></i></div>
                  <div class="count"><?php echo $iri_dankir; ?> m</div>
                  <h3>D.I Danasari Kiri</h3>
                  <p>Saluran Irigasi</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-home"></i></div>
                  <div class="count"><?php echo $bgn_nanggela; ?> unit</div>
                  <h3>D.I Nanggela</h3>
                  <p>Bangunan Pelengkap</p>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 ">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-home"></i></div>
                  <div class="count"><?php echo $bgn_dankir; ?> unit</div>
                  <h3>D.I Danasari Kiri</h3>
                  <p>Bangunan Pelengkap</p>
                </div>
              </div>
            <!--</div>-->
          </div>

          <div class="row">

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2><small>Saluran Irigasi berdasarkan</small> Fungsi</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">1</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Primer D.I Nanggela</a>
                      <p>Panjang <b><?php echo $primer_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">2</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Sekunder D.I Nanggela</a>
                      <p>Panjang <b><?php echo $sekunder_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">&nbsp;</p>
                      <p class="day">&nbsp;</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#"></a>
                      <p></p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">3</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Primer D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $primer_dankir; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">4</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Primer D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $sekunder_dankir; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">&nbsp;</p>
                      <p class="day">&nbsp;</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#"></a>
                      <p></p>
                    </div>
                  </article>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2><small>Saluran Irigasi berdasarkan </small>Konstruksi</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.1</p>
                      <p class="day">1</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Konstruksi Beton D.I Nanggela</a>
                      <p>Panjang <b><?php echo $sbeton_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">2</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Konstruksi Pasangan Batu Kali D.I Nanggela</a>
                      <p>Panjang <b><?php echo $sbatu_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">3</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Konstruksi Tanah D.I Nanggela</a>
                      <p>Panjang <b><?php echo $stanah_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">4</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Konstruksi Beton D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $sbeton_dankir; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">5</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Konstruksi Pasangan Batu Kali D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $sbatu_dankir; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">6</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Konstruksi Tanah D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $stanah_dankir; ?></b> meter</p>
                    </div>
                  </article>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2><small>Saluran Irigasi berdasarkan </small>Kondisi</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">1</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Kondisi Baik D.I Nanggela</a>
                      <p>Panjang <b><?php echo $sbaik_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">2</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Kondisi Sedang D.I Nanggela</a>
                      <p>Panjang <b><?php echo $ssedang_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">3</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Kondisi Buruk D.I Nanggela</a>
                      <p>Panjang <b><?php echo $sburuk_nanggela; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">4</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Kondisi Baik D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $sbaik_dankir; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">5</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Kondisi Sedang D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $ssedang_dankir; ?></b> meter</p>
                    </div>
                  </article>
                  <article class="media event">
                    <a class="pull-left date">
                      <p class="month">No.</p>
                      <p class="day">6</p>
                    </a>
                    <div class="media-body">
                      <a class="title" href="#">Saluran Irigasi Kondisi Buruk D.I Danasari Kiri</a>
                      <p>Panjang <b><?php echo $sburuk_dankir; ?></b> meter</p>
                    </div>
                  </article>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-6 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2><small>Bangunan Pelengkap berdasarkan </small>Konstruksi</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="col-md-6 hidden-small">
                      <h2 class="line_30">D.I Nanggela</h2>
                      <table class="countries_list">
                        <tbody>
                          <tr>
                            <td>Beton</td>
                            <td class="fs15 fw700 text-right"><?php echo $beton_nanggela; ?></td>
                          </tr>
                          <tr>
                            <td>Pasangan Batu Kali</td>
                            <td class="fs15 fw700 text-right"><?php echo $batu_nanggela; ?></td>
                          </tr>
                          <tr>
                            <td>Tanah</td>
                            <td class="fs15 fw700 text-right"><?php echo $tanah_nanggela; ?></td>
                          </tr>
                          <tr>
                            <td>Pasangan Bata</td>
                            <td class="fs15 fw700 text-right"><?php echo $bata_nanggela; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6 col-sm-12 ">
                      <h2 class="line_30">D.I Danasari Kiri</h2>
                      <table class="countries_list">
                        <tbody>
                          <tr>
                            <td>Beton</td>
                            <td class="fs15 fw700 text-right"><?php echo $beton_dankir; ?></td>
                          </tr>
                          <tr>
                            <td>Pasangan Batu Kali</td>
                            <td class="fs15 fw700 text-right"><?php echo $batu_dankir; ?></td>
                          </tr>
                          <tr>
                            <td>Tanah</td>
                            <td class="fs15 fw700 text-right"><?php echo $tanah_dankir; ?></td>
                          </tr>
                          <tr>
                            <td>Pasangan Bata</td>
                            <td class="fs15 fw700 text-right"><?php echo $bata_dankir; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-12 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2><small>Bangunan Pelengkap berdasarkan </small>Kondisi</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <div class="col-md-6 hidden-small">
                      <h2 class="line_30">D.I Nanggela</h2>
                      <table class="countries_list">
                        <tbody>
                          <tr>
                            <td>Baik</td>
                            <td class="fs15 fw700 text-right"><?php echo $baik_nanggela; ?></td>
                          </tr>
                          <tr>
                            <td>Sedang</td>
                            <td class="fs15 fw700 text-right"><?php echo $sedang_nanggela; ?></td>
                          </tr>
                          <tr>
                            <td>Buruk</td>
                            <td class="fs15 fw700 text-right"><?php echo $buruk_nanggela; ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="fs15 fw700 text-right">&nbsp;</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6 col-sm-12 ">
                      <h2 class="line_30">D.I Danasari Kiri</h2>
                      <table class="countries_list">
                        <tbody>
                          <tr>
                            <td>Baik</td>
                            <td class="fs15 fw700 text-right"><?php echo $baik_dankir; ?></td>
                          </tr>
                          <tr>
                            <td>Sedang</td>
                            <td class="fs15 fw700 text-right"><?php echo $sedang_dankir; ?></td>
                          </tr>
                          <tr>
                            <td>Buruk</td>
                            <td class="fs15 fw700 text-right"><?php echo $buruk_dankir; ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="fs15 fw700 text-right">&nbsp;</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!--</div>-->
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
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>
