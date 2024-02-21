<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta name="description" content="ArcGIS JS v4, Calcite Maps and Bootstrap Example">
 
  <title>Si-TARUNG Kota Cimahi</title>
  
  <link rel="icon" type="image/png" href="assets/img/cimahi.ico"/>
  
  <!-- Calcite Maps Bootstrap -->
  <link rel="stylesheet" href="https://esri.github.io/calcite-maps/dist/css/calcite-maps-bootstrap.min-v0.10.css">
  
  <!-- Calcite Maps -->
  <link rel="stylesheet" href="https://esri.github.io/calcite-maps/dist/css/calcite-maps-arcgis-4.x.min-v0.10.css">

  <!-- ArcGIS JS 4 -->
  <link rel="stylesheet" href="https://js.arcgis.com/4.20/esri/css/main.css">

  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
    }
	
	#topbar {
        background: #fff;
        padding: 10px;
		top: 60px;
      }

      .action-button {
        font-size: 16px;
        background-color: transparent;
        border: 1px solid #d3d3d3;
        color: #6e6e6e;
        height: 32px;
        width: 32px;
        text-align: center;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.3);
      }

      .action-button:hover,
      .action-button:focus {
        background: #0079c1;
        color: #e4e4e4;
      }

      .active {
        background: #0079c1;
        color: #e4e4e4;
      }
  </style>

</head>

<body class="calcite-maps calcite-nav-top">
  <!-- Navbar -->

  <nav class="navbar calcite-navbar navbar-fixed-top calcite-text-light calcite-bg-dark calcite-bgcolor-black">
    <!-- Menu -->
    <div class="dropdown calcite-dropdown calcite-text-dark calcite-bg-light" role="presentation">
      <a class="dropdown-toggle" role="menubutton" aria-haspopup="true" aria-expanded="false" tabindex="0">
        <div class="calcite-dropdown-toggle">
          <span class="sr-only">Toggle dropdown menu</span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </a>
      <ul class="dropdown-menu" role="menu">		
		    <li><a role="menuitem" tabindex="0" href="#" data-target="#panelBasemaps" aria-haspopup="true"><span class="glyphicon glyphicon-th-large"></span> Basemaps</a></li>
        <!--<li><a role="menuitem" tabindex="0" href="#" data-target="#panelLayer" aria-haspopup="true"><span class="glyphicon glyphicon-th-list"></span> Layer</a></li>-->
        <li><a role="menuitem" tabindex="0" href="#" data-target="#panelLegend" aria-haspopup="true"><span class="glyphicon glyphicon-list-alt"></span> Legend</a></li>
        <li><a role="menuitem" tabindex="0" href="#" data-target="#panelFind" aria-haspopup="true"><span class="glyphicon glyphicon-th-list"></span> Table Pengaduan</a></li>
        <!--<li><a role="menuitem" tabindex="0" href="#" data-target="#panelEditor" aria-haspopup="true"><span class="glyphicon glyphicon-edit"></span> Editor</a></li>
        <li><a role="menuitem" tabindex="0" href="#" data-target="#panelMeasurement" aria-haspopup="true"><span class="glyphicon glyphicon-resize-full"></span> Measurement</a></li>-->
        <li><a role="menuitem" tabindex="0" href="#" data-target="#panelPrint" aria-haspopup="true"><span class="glyphicon glyphicon-print"></span> Print</a></li>
		    <!--<li><a role="menuitem" tabindex="0" href="#" data-target="#panelReport" aria-haspopup="true"><span class="glyphicon glyphicon-file"></span> Report</a></li>
        <li><a role="menuitem" tabindex="0" href="#" id="calciteToggleNavbar" aria-haspopup="true"><span class="glyphicon glyphicon-fullscreen"></span> Full Map</a></li>
        <li><a role="menuitem" tabindex="0" data-target="#panelInfo" aria-haspopup="true"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>-->
      </ul>
    </div>
    <!-- Title -->
    <div class="calcite-title calcite-overflow-hidden">
      <span class="calcite-title-main">
		<img src="assets/img/logo.png" style="width: 150px; height: 35px;">
	  </span>
      <span class="calcite-title-divider hidden-xs"></span>
      <span class="calcite-title-sub hidden-xs">Peta Pengendalian Tata Ruang Kota Cimahi</span>
	    <input type="hidden" id="usrgroup" value="<?php echo $_SESSION["usergroup"]; ?>">
    </div>
    <!-- Nav -->
    <ul class="nav navbar-nav calcite-nav">
      <!--<li class="dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"><span class="glyphicon glyphicon-user"></span> Layanan Publik <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li>
            <a href="form_pengaduan.php"><span class="glyphicon glyphicon-comment"></span> Pengaduan Tata Ruang</a>
          </li>
          <li>
            <a href="pengaduan.php"><span class="glyphicon glyphicon-record"></span> Peta Pengaduan</a>
          </li>
        </ul>
      </li>
      <li class="dropdown">
        <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"><span class="glyphicon glyphicon-globe"></span> Peta <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li>
            <a href="map.php"><span class="glyphicon glyphicon-globe"></span> Peta Pola Ruang</a>
          </li>
          <li>
            <a href="menara.php"><span class="glyphicon glyphicon-map-marker"></span> Sebaran Menara</a>
          </li>
          <li>
            <a href="minimarket.php"><span class="glyphicon glyphicon-map-marker"></span> Sebaran Minimarket</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="about.php"><span class="glyphicon glyphicon-repeat"></span> Tentang Si-Tarung</a>
      </li>
      <li>
        <a href="index.php"><span class="glyphicon glyphicon-home"></span> Beranda</a>
      </li>-->
      <li>
        <div class="calcite-navbar-search calcite-search-expander">
          <div id="searchWidgetDiv"></div>
		      <!--<a href="../index.php" class="btn btn-primary active" role="button" aria-pressed="true"><span class="glyphicon glyphicon-home"></span> Beranda</a>-->
        </div>
      </li>
    </ul>
  </nav>

  <!--/.calcite-navbar -->

  <!-- Map  -->

  <div class="calcite-map calcite-map-absolute">
    <div id="mapViewDiv"></div>
	<div id="topbar">
      <button class="action-button esri-icon-measure-line" id="distanceButton" type="button" title="Measure distance between two or more points"></button>
      <button class="action-button esri-icon-measure-area" id="areaButton" type="button" title="Measure area"></button>
    </div>
  </div>

  <!-- /.calcite-map -->

  <!-- Panels -->

  <div class="calcite-panels calcite-panels-right calcite-bg-custom calcite-text-light calcite-bgcolor-black panel-group">

    <!-- Panel - About -->

    <div id="panelInfo" class="panel collapse">
      <div id="headingInfo" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseInfo"  aria-expanded="true" aria-controls="collapseInfo"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><span class="panel-label">About</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelInfo"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a>  
        </div>
      </div>
      <div id="collapseInfo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingInfo">
        <div class="panel-body">
          <p>GIS Aset Prasarana PT. Kereta Api Indonesia (Persero)</p>
        </div>
     </div>
    </div>

    <!-- Panel - Legend -->

    <div id="panelLegend" class="panel collapse">
      <div id="headingLegend" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseLegend" aria-expanded="false" aria-controls="collapseLegend"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="panel-label">Legend</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelLegend"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapseLegend" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingLegend">
        <div class="panel-body">            
          <div id="legendDiv"></div>
        </div>
      </div>
    </div>
	
    <!-- Panel - Editor -->

    <div id="panelEditor" class="panel collapse">
      <div id="headingEditor" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseEditor" aria-expanded="false" aria-controls="collapseEditor"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="panel-label">Editor</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelEditor"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapseEditor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEditor">
        <div class="panel-body">            
          <div id="editorDiv"></div>
        </div>
      </div>
    </div>
	
    <!-- Panel - Upload Foto -->

    <div id="panelUpload" class="panel collapse">
      <div id="headingcenter" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseUpload" aria-expanded="false" aria-controls="collapseUpload"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span><span class="panel-label">Update Status Pengaduan</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelUpload"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapseUpload" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingcenter">
        <div class="panel-body">            
          <form id="form-data" enctype="multipart/form-data">
            <div id="centerDiv">
              <div class="form-group">
                <input type="text" class="form-control" id="textOID" value="" disabled /><br />
                <label for="thing1" class="control-label">Nama :</label>
                <input type="text" class="form-control" id="textNama" value="" disabled /><br />
                <label for="thing1" class="control-label">NIK :</label>
                <input type="text" class="form-control" id="textNIK" value="" disabled /><br />
                <!--<label for="thing1" class="control-label">Foto 2 (*.jpg) :</label>
                <input type="file" accept="image/jpeg, image/jpg" class="form-control" id="textFoto2" /><br />-->
                <label for="thing1" class="control-label">Status :</label>                
                <select class="form-control" id="textStatus">
                  <option value="Diproses">Diproses</option>
                  <option value="Selesai">Selesai</option>
                </select><br />
                <label for="thing1" class="control-label">Keterangan :</label>                
                <textarea id="textKeterangan" class="form-control" rows="5"></textarea><br />
              </div>
              <button type="button" class="btn btn-primary" id="btnSave">Save</button>
              <button type="button" class="btn btn-primary" id="btnClose">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <!-- Panel - Find -->

    <div id="panelFind" class="panel collapse">
      <div id="headingFind" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseFind" aria-expanded="false" aria-controls="collapseFind"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="panel-label">Daftar Pengaduan</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelFind"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapseFind" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFind">
        <div class="panel-body">            
          <div id="findDiv">
			      <div class="form-group">
			        <label class="control-label" for="thing1">Filter Status :</label>
			        <!--<input type="text" class="form-control" placeholder="Masukan data yang dicari" id="textSearch">-->
              <select id="textSearch" class="form-control">
                <option value="" data-nav="navbar-fixed-top" selected>Semua</option>
                <option value="Diterima" data-nav="navbar-fixed-top">Diterima</option>
                <option value="Diproses" data-nav="navbar-fixed-top">Diproses</option>
                <option value="Selesai" data-nav="navbar-fixed-top">Selesai</option>
              </select>
			      </div>
			      <button type="button" class="btn btn-secondary" id="findBtn">Refresh </button>
			      <button type="button" class="btn btn-secondary" id="clearBtn">Clear</button>
			      <br />
		      </div><br />
		      <p><b><span id="printResults"></span></b></p>
		      <table class="table table-hover" id="tblFind"></table>
        </div>
      </div>
    </div>
	
    <!-- Panel - Measurement -->

    <div id="panelMeasurement" class="panel collapse">
      <div id="headingMeasurement" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseMeasurement" aria-expanded="false" aria-controls="collapseMeasurement"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="panel-label">Measurement</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelMeasurement"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapseMeasurement" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingMeasurement">
        <div class="panel-body">            
          <div id="measurementDiv">
			
		  </div>
        </div>
      </div>
    </div>
	
    <!-- Panel - Report -->

    <div id="panelReport" class="panel collapse">
      <div id="headingReport" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseReport" aria-expanded="false" aria-controls="collapseReport"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span class="panel-label">Report</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelReport"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapseReport" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingReport">
        <div class="panel-body">            
          <div id="ReportDiv">
			1. <a href="#">Berita Acara Pengawasan</a><br>
			2. <a href="#">Data Ijin Bangunan</a>
			<!--<div id="topbar">
				<button class="action-button esri-icon-measure-line" id="distanceButton" type="button" title="Measure distance between two or more points"></button>
				<button class="action-button esri-icon-measure-area" id="areaButton" type="button" title="Measure area"></button>
			</div>-->
		  </div>
        </div>
      </div>
    </div>
	
	<!-- Panel - Layer -->

    <div id="panelLayer" class="panel collapse">
      <div id="headingLayer" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapseLayer" aria-expanded="false" aria-controls="collapseMeasurement"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><span class="panel-label">Layer</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelLayer"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapseLayer" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingLayer">
        <div class="panel-body">            
          <div id="layerDiv"></div>
        </div>
      </div>
    </div>

	<!-- Panel - Print -->

    <div id="panelPrint" class="panel collapse">
      <div id="headingPrint" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle" role="button" data-toggle="collapse" href="#collapsePrint" aria-expanded="false" aria-controls="collapseMeasurement"><span class="glyphicon glyphicon-print" aria-hidden="true"></span><span class="panel-label">Print</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelPrint"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a> 
        </div>
      </div>
      <div id="collapsePrint" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPrint">
        <div class="panel-body">            
          <div id="printDiv"></div>
        </div>
      </div>
    </div>

	<!-- Basemaps Panel -->
    
    <div id="panelBasemaps" class="panel collapse"> 
      <div id="headingBasemaps" class="panel-heading" role="tab">
        <div class="panel-title">
          <a class="panel-toggle collapsed" role="button" data-toggle="collapse" href="#collapseBasemaps" aria-expanded="false"   aria-controls="collapseBasemaps"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span><span class="panel-label">Basemaps</span></a> 
          <a class="panel-close" role="button" data-toggle="collapse" tabindex="0" href="#panelBasemaps"><span class="esri-icon esri-icon-close" aria-hidden="true"></span></a>  
        </div>
      </div>
      <div id="collapseBasemaps" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingBasemaps">
        <div class="panel-body">
          <div id="basemapDiv"></div>
        </div>
      </div>
    </div>
	
  </div>

  <!-- /.calcite-panels -->

  <script type="text/javascript">
    var dojoConfig = {
      packages: [{
        name: "bootstrap",
        location: "https://esri.github.io/calcite-maps/dist/vendor/dojo-bootstrap"
      },
      {
        name: "calcite-maps",
        location: "https://esri.github.io/calcite-maps/dist/js/dojo"
      }]
    };
  </script>

  <!-- ArcGIS JS 4 -->
  <script src="https://js.arcgis.com/4.20/"></script>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

  <script type="text/javascript" src="js/viewer_kendali.js">
        
  </script>

</body>
</html>