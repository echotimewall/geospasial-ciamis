
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Tata Ruang Kota Cimahi">
    <meta name="author" content="Nonok Dwi Antoro">
    <meta name="generator" content="Nonok 0.84.0">
    <title>Si-Tarung Kota Cimahi</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/">
	<!--<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">-->
    
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

    <!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Vendor CSS Files -->
	<!--<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">-->
	<link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!--<link href="assets/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
	<link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="assets/vendor/venobox/venobox.css" rel="stylesheet">-->
	
    <!-- Favicons -->
	<link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="images/bekasi.png" sizes="32x32" type="image/png">
	<link rel="icon" href="images/bekasi.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
	<link rel="icon" href="../assets/img/logo.png">
	<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      #viewDiv {
        padding: 0;
        margin: 0;
        height: 100%;
        width: 100%;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">
	<!--<link href="https://getbootstrap.com/docs/5.0/examples/cover/cover.css" rel="stylesheet">-->

    <link rel="stylesheet" href="https://js.arcgis.com/4.20/esri/css/main.css">
  
  <script>
    
  </script>
	
  </head>
  <body class="d-flex flex-column h-100">      
  
    <main class="flex-shrink-0">
    <div class="container">
        <!--<h4 class="mt-5">Pengaduan Tata Ruang</h4>-->
        <hr>
        <div class="row">
            <div class="col-md-6 order-md-2">
                <div id="viewDiv"></div>
            </div>
            <div class="col-md-6 order-md-1">
            <!--<h4 class="mb-3">Billing address</h4>-->
            <form id="frmAdu" class="needs-validation" novalidate enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Contoh : Akhmad Sugiarto" value="" required>
                    <div class="invalid-feedback">
                    Nama Lengkap yang valid wajid diisi.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" class="form-control form-control-sm" name="nik" id="nik" placeholder="16 Digit" value="" required>
                    <div class="invalid-feedback">
                    NIK yang valid wajib diisi.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username">Nomor Telepon</label>
                    <input type="text" class="form-control form-control-sm" name="notelp" id="notelp" placeholder="Nomor Telepon" required>
                    <div class="invalid-feedback" style="width: 100%;">
                    Nomor Telepon yang valid wajib diisi.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Masukan alamat Email yang valid untuk info pelaporan anda.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Nama jalan atau lokasi</label>
                    <input type="text" class="form-control form-control-sm" name="alamat" id="alamat" placeholder="Contoh : Jalan Sudirman" required>
                    <div class="invalid-feedback">
                        Masukan alamat atau lokasi tempat laporan anda.
                    </div>
                </div>
                </div>

                <div class="mb-3">
                <label for="address2">Laporan Anda</label>
                <textarea class="form-control form-control-sm" name="pesan" id="pesan" placeholder="Contoh : Bangunan kantor A dijalan B tidak sesuai dengan daerah peruntukannya" rows="5"></textarea>
                <!--<input type="text" class="form-control" id="address2" placeholder="Apartment or suite">-->
                </div>

                <div class="mb-3">
                <label for="address2">Lampirkan File/Foto</label>
                <input type="file" class="form-control form-control-sm" name="file" id="file" placeholder="Apartment or suite">
                </div>

                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Longitude *</label>
                    <input type="text" class="form-control form-control-sm" name="long" id="long" placeholder="" required>
                    <div class="invalid-feedback">
                    Koordinat Longitude wajib diisi
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Latitude *</label>
                    <input type="text" class="form-control form-control-sm" name="lat" id="lat" placeholder="" required>                
                    <div class="invalid-feedback">
                    Koordinat Latitude wajib diisi
                    </div>
                </div>
                </div>
                <small class="text-muted">Anda diwajibkan mengisi lokasi anda pada kolom latitude dan longitude. Untuk mendapatkan posisi laporan anda, Anda dapat mengklik lokasi yang dilaporkan pada peta disamping.</small>
                <hr class="mb-4">
                <!--<button class="btn btn-primary btn-lg btn-block" type="button" onclick="validateForm()">Kirim Laporan</button>-->
                <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block submitBtn" value="Kirim Laporan"/>
            </form>
            </div>
        </div>        
        <hr>
    </div>
    <br />
    </main>
  
<script src="https://js.arcgis.com/4.20/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <!-- <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->
    <script>
      var map, view, pointOnTheMap;

      require([
        "esri/Map",
        "esri/views/MapView",
        "esri/layers/FeatureLayer",
        "esri/widgets/Attribution",
        "esri/widgets/Expand", 
        "esri/widgets/BasemapGallery",
        "esri/Graphic"
      ], function(Map, MapView, FeatureLayer, Attribution, Expand, BasemapGallery, Graphic) {

        var url = "http://www.kav-32.com/arcgis/rest/services/bappeda/MapServer/0";
        var bts_kec = new FeatureLayer({url,
          title: "BATAS ADMINISTRASI",
          outFields: ["*"],
          visible: true,
          popupEnabled: false
          //,
          //popupTemplate: template
        });
        
        map = new Map({
          basemap: "hybrid",
          layers: [bts_kec]
        });

        view = new MapView({
          container: "viewDiv",
          map: map,
          center: [108.3519775, -7.3263733], // longitude, latitude
          zoom: 17
        });

        var attribution = new Attribution({
			view: view,
			visible: false
		});
		view.ui.add(attribution, "manual");

        const basemapGallery = new BasemapGallery({
          view: view
        });

        const bgExpand = new Expand({
          view: view,
          content: basemapGallery
        });
        view.ui.add(bgExpand, "top-right");
        
        //view.ui.add("instruction", "bottom-left");

        var simpleMarkerSymbol = {
          type: "simple-marker",
          color: [226, 119, 40],  // orange
          outline: {
            color: [255, 255, 255], // white
            width: 1
          }
        };

        //create a Graphic without geometry - this will be set later
        pointOnTheMap = new Graphic({
          symbol: simpleMarkerSymbol
        });

        // add the 'invisible' Graphic to the MapView
        view.graphics.add(pointOnTheMap);
          view.popup.autoOpenEnabled = false;
          view.on("click", function(event) {
            // Get the coordinates of the click on the view
            var longitude = event.mapPoint.longitude;
            var latitude = event.mapPoint.latitude;
            // Round the coordinates for visualization purposes
            var lon = Math.round(longitude * 1000) / 1000;
            var lat = Math.round(latitude * 1000) / 1000;
    
            var point = {
            type: "point",
            longitude: longitude, // Please make sure to use the unrounded values
            latitude: latitude    // otherwise your point will appear in the wrong spot
          };

            pointOnTheMap.geometry = point;

            /*view.popup.open({
              title: "Reverse geocode: [" + longitude + ", " + latitude + "]",
              location: event.mapPoint // Set the location of the popup to the clicked location
            });*/

            document.getElementById("long").value = longitude;
            document.getElementById("lat").value = latitude; 
          });
        });

        $(document).ready(function(e){
          // Submit form data via Ajax
          $("#frmAdu").on('submit', function(e){
              e.preventDefault();
              //alert('a');
              $.ajax({
                  type: 'POST',
                  url: 'send_message.php',
                  data: new FormData(this),
                  dataType: 'json',
                  contentType: false,
                  cache: false,
                  processData:false,
                  beforeSend: function(){
                      //$('.submitBtn').attr("disabled","disabled");
                      $('#frmAdu').css("opacity",".5");
                  },
                  success: function(response){ //console.log(response);
                      //var json = JSON.parse(response);
                      alert(response[0].Message);
                      $('#frmAdu')[0].reset();
                      /*$('.statusMsg').html('');
                      if(response.status == 1){
                          $('#fupForm')[0].reset();
                          $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                      }else{
                          $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                      }*/
                      $('#frmAdu').css("opacity","");
                      //$(".submitBtn").removeAttr("disabled");
                      //pointOnTheMap.clear();
                  }
              });
          });
        });

        function validateForm() {                        
            
            var nmFoto = document.getElementById("foto").files[0]['name'];

            formData = {
                'nama'     : $('input[name=nama]').val(),
                'nik'      : $('input[name=nik]').val(),
                'notelp'   : $('input[name=notelp]').val(),
                'email'    : $('input[name=email]').val(),
                'alamat'   : $('input[name=alamat]').val(),
                'pesan'  : $('textarea[name=pesan]').val(),
                'foto'  : nmFoto, //$('file[name=foto]').val(),
                'file'  : $('input[name=foto]').val(),
                'x'     : $('input[name=long]').val(),
                'y'     : $('input[name=lat]').val()
            };

            $.ajax({
                url : "send_message.php",
                type: "POST",
                data : formData,
                success: function(data, textStatus, jqXHR)
                {
                  var json = JSON.parse(data);
                  alert(json[0].Message);
                  clearForm();
                  view.graphics.removeAll();                  
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Pengiriman Pengaduan Error !')
                }
            });
        }

        function clearForm() {
          document.getElementById("frmAdu").reset();
        }
    </script>
      
  </body>
</html>
