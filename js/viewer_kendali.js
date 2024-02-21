require([
	// ArcGIS
	"esri/Map",
	"esri/WebMap",
	"esri/views/MapView",
	"esri/layers/FeatureLayer",
	"esri/tasks/FindTask",
	"esri/tasks/support/FindParameters",
	"esri/tasks/QueryTask", 
	"esri/tasks/support/Query",
	"esri/renderers/SimpleRenderer",
	"esri/layers/support/LabelClass",
	"esri/layers/CSVLayer",
	"esri/layers/GraphicsLayer",
	"esri/Graphic",
	"esri/layers/VectorTileLayer",
	"esri/layers/KMLLayer",
	"esri/layers/MapImageLayer",
	"esri/layers/GroupLayer",
	
	// Widgets
	"esri/widgets/Home",
	"esri/widgets/Zoom",
	"esri/widgets/Compass",
	"esri/widgets/Search",
	"esri/widgets/Legend",
	"esri/widgets/BasemapToggle",
	"esri/widgets/BasemapGallery",
	"esri/widgets/ScaleBar",
	"esri/widgets/Attribution",
	"esri/widgets/LayerList",
	"esri/widgets/Print",
	"esri/widgets/Measurement",
	"esri/widgets/DistanceMeasurement2D",
	"esri/widgets/AreaMeasurement2D",
	"esri/widgets/Editor",
	"esri/widgets/Locate",

	// Bootstrap
	"bootstrap/Collapse",
	"bootstrap/Dropdown",

	// Calcite Maps
	"calcite-maps/calcitemaps-v0.10",
	// Calcite Maps ArcGIS Support
	"calcite-maps/calcitemaps-arcgis-support-v0.10",

	"dojo/store/Memory",
	"dojo/query",
	"dojo/domReady!"
  ], function(Map, WebMap, MapView, FeatureLayer, FindTask, FindParameters, QueryTask, Query, SimpleRenderer, LabelClass, CSVLayer, GraphicsLayer, Graphic, 
  VectorTileLayer, KMLLayer, MapImageLayer, GroupLayer, Home, Zoom, Compass, Search, Legend, BasemapToggle, BasemapGallery, 
  ScaleBar, Attribution, LayerList, Print, Measurement, DistanceMeasurement2D, AreaMeasurement2D, Editor, Locate, Collapse, Dropdown, CalciteMaps, CalciteMapArcGISSupport, Memory, query) {

	  var activeWidget = null,
		  csvLayer,
		  csvLayerView,
		  highlight;
	  //var layerList;

	  var renderer = {
		type: "simple",  // autocasts as new SimpleRenderer()
		symbol: {
		  type: "simple-fill",  // autocasts as new SimpleFillSymbol()
		  color: [ 255, 128, 0, 0.1 ],
		  outline: {  // autocasts as new SimpleLineSymbol()
			width: 0.5,
			color: "#404040",			  
			style: "dash"
		  }
		}
	  };
  
	  var trailheadsLabels = {
		  symbol: {
			type: "text",
			color: "#0026FF",
			haloColor: "#ffffff",//"#7F92FF",
			haloSize: "1px",
			font: {
			  size: "12px",
			  family: "Noto Sans",
			  style: "italic",
			  weight: "normal"
			}
		  },
		  labelPlacement: "above-center",
		  labelExpressionInfo: {
			  expression: "$feature.PEMOHON"
		  }
	  };
	
	  function countyName(feature) {
		  return feature.graphic.layer.title;
	  }
	
	  var imgUrl = "http://www.kav-32.com/sitarung/content/pengaduan/";
	  var template = {
		  title: countyName,
		  content: [{
			  type: "fields",
			  fieldInfos: [{
				  fieldName: "Nama",
				  label: "Nama"
			  },
			  {
				  fieldName: "NIK",
				  label: "NIK"
			  },
			  {
				  fieldName: "No_Telp",
				  label: "Nomor Telepon"
			  },
			  {
				  fieldName: "Email",
				  label: "Email"
			  },
			  {
				  fieldName: "Lokasi",
				  label: "Nama Jalan / Lokasi"
			  },
			  {
				  fieldName: "Laporan",
				  label: "Laporan"
			  },
			  {
				  fieldName: "x",
				  label: "Longitude"
			  },
			  {
				  fieldName: "y",
				  label: "Latitude"
			  },
			  {
				  fieldName: "Status",
				  label: "Status"
			  },
			  {
				  fieldName: "Keterangan",
				  label: "Keterangan"
			  }]
		  }, {
			  type: "media",
			  mediaInfos: [{
				  title: 'Foto Lampiran',
				  caption: '{Foto}',
				  type: 'image',
				  value: {
					  sourceURL: imgUrl + "{Foto}",
					  linkURL: imgUrl + "{Foto}"
				  }
			  }]
		  }],
		  actions: [ {
			  title: "Edit Status",
			  id: "edit-this",
			  className: "esri-icon-edit"
		  }]
	  };
	  
	  url = "http://www.kav-32.com/arcgis/rest/services/SITARUNG2/MapServer/0";
	  var menara = new FeatureLayer({url,
		  title: "PENGADUAN",
		  outFields: ["*"],
		  visible: true,
		  popupEnabled: true,
		  popupTemplate: template
	  });			  
	
	  template = {
		  title: countyName,
		  content: [{
			  type: "fields",
			  fieldInfos: [{
				  fieldName: "DESA",
				  label: "DESA"
			  },
			  {
				  fieldName: "KECAMATAN",
				  label: "KECAMATAN"
			  },
			  {
				  fieldName: "KABUPATEN",
				  label: "KAB/KOTA"
			  },
			  {
				  fieldName: "PROVINSI",
				  label: "PROVINSI"
			  }]
		  }]
	  };
	  
	  url = "http://www.kav-32.com/arcgis/rest/services/SITARUNG2/MapServer/1";
	  var bts_kec = new FeatureLayer({url,
		  title: "BATAS ADMINISTRASI",
		  outFields: ["*"],
		  visible: true,
		  popupEnabled: true,
		  popupTemplate: template
	  });				  
		  
	  var map = new Map({
		  basemap: "topo",
		  layers: [bts_kec, menara]
	  });
		  
	  var mapView = new MapView({
		  container: "mapViewDiv",
		  map: map,
		  center: [107.543123, -6.885123],
		  zoom: 13,
		  padding: {
			top: 50,
			bottom: 0
		  },
		  showLabels: true,
		  ui: {components: []}
	  });
			  
	  function editAttribute() {
		mapView.popup.visible = false;
		query("#panelUpload").collapse("show");
		query("#collapseUpload").collapse();
		var oid = mapView.popup.selectedFeature.attributes.OBJECTID;
		var nama = mapView.popup.selectedFeature.attributes.Nama;
		var nik = mapView.popup.selectedFeature.attributes.NIK;
		document.getElementById("textOID").value = oid;
		document.getElementById("textNama").value = nama;
		document.getElementById("textNIK").value = nik;
	  }

	  mapView.popup.on("trigger-action", function(event) {
		if (event.action.id === "edit-this") {
			editAttribute();								
		}
	  });

	  function doSave() {
		const status = $('#textStatus').val();
		const keterangan = $('#textKeterangan').val();
		var oid = $('#textOID').val();

		if (oid!="") {
			let formData = new FormData();
			formData.append('oid', oid);
			formData.append('status', status);
			formData.append('keterangan', keterangan);

			$.ajax({
				type: 'POST',
				url: "update_status.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function (data) {
					menara.refresh();
					var json = JSON.parse(data);
					alert(json[0].Message);						
					doClose();
				},
				error: function () {
					alert("Proses update status gagal.");
				}
			});
		}	
	  }

	  function doClose() {
		document.getElementById('form-data').reset();
		query("#panelUpload").collapse("hide");
		mapView.popup.visible = true;
	  }

	  document.getElementById("btnSave").addEventListener("click", doSave);
	  document.getElementById("btnClose").addEventListener("click", doClose);  		
	
	  var searchWidget = new Search({
		container: "searchWidgetDiv",
		view: mapView
	  });
	  CalciteMapArcGISSupport.setSearchExpandEvents(searchWidget);

	  var home = new Home({
		  view: mapView
	  });
	  mapView.ui.add(home, "top-left");

	  var zoom = new Zoom({
		  view: mapView
	  });
	  mapView.ui.add(zoom, "top-left");

	  var locateBtn = new Locate({
		  view: mapView
	  });
	  mapView.ui.add(locateBtn, "top-left");
	
	  /*var basemapToggle = new BasemapToggle({
		  view: mapView,
		  secondBasemap: "satellite"
	  });
	  mapView.ui.add(basemapToggle, "bottom-right");*/
	
	  var scaleBar = new ScaleBar({
		  view: mapView,
		  style: "ruler",
		  unit: "metric"
	  });
	  mapView.ui.add(scaleBar, "bottom-right");

	  var attribution = new Attribution({
		  view: mapView,
		  visible: false
	  });
	  mapView.ui.add(attribution, "manual");

	  var legendWidget = new Legend({
		  container: "legendDiv",
		  view: mapView
	  });
	
	  var editorWidget = new Editor({
		  container: "editorDiv",
		  //label: "Pengawasan",
		  view: mapView
	  });
	
	  function defineActions(event) {

		  var item = event.item;

		  if (item.layer.type != "group") {
			  item.panel = {
				  content: "legend",
				  open: item.title === "PENGADUAN"
			  };
		  }
	  
		  if (item.title === "POLA RUANG" || item.title === "BANGUNAN FASUM" || item.title === "KONTUR") {
			  item.actionsSections = [
			  [
				  {
				  title: "Go to full extent",
				  className: "esri-icon-zoom-out-fixed",
				  id: "full-extent"
				  }				
			  ],
			  [
				  {
				  title: "Increase opacity",
				  className: "esri-icon-up",
				  id: "increase-opacity"
				  },
				  {
				  title: "Decrease opacity",
				  className: "esri-icon-down",
				  id: "decrease-opacity"
				  }
			  ]
			  ];
		  }
	  }				  
		
	  mapView.when(function() {
		  var print = new Print({
			  view: mapView,
			  container: "printDiv",
			  printServiceUrl:
				"https://utility.arcgisonline.com/arcgis/rest/services/Utilities/PrintingTools/GPServer/Export%20Web%20Map%20Task"
		  });

		  var basemapGallery = new BasemapGallery({
			  view: mapView,
			  container: "basemapDiv"
		  });
	  
		  var layerList = new LayerList({
			  container: "layerDiv",
			  view: mapView,
			  listItemCreatedFunction: defineActions
		  });

		  layerList.on("trigger-action", function(event) {
			  var visibleLayer = rdtr;
			  if (event.item.title === "POLA RUANG")
				  visibleLayer = rdtr;
			  else if (event.item.title === "BANGUNAN FASUM")
				  visibleLayer = sungai_bsr;
			  else if (event.item.title === "KONTUR")
				  visibleLayer = site;
			
			  var id = event.action.id;
	
			  if (id === "full-extent") {
				mapView.goTo(visibleLayer.fullExtent);
			  } else if (id === "increase-opacity") {
				if (visibleLayer.opacity < 1) {
				  visibleLayer.opacity += 0.25;
				}
			  } else if (id === "decrease-opacity") {
				if (visibleLayer.opacity > 0) {
				  visibleLayer.opacity -= 0.25;
				}
			  }
		  });		
			
		  mapView.ui.add(layerList, "bottom-left");
	  });

	  function doFind() {
		  //var lyr = document.getElementById("layerSearch").value;
		  //var field = document.getElementById("fieldSearch").value;
		  var value = document.getElementById("textSearch").value;
					  
		  //csvLayerView = site;
		  
		  var kriteria = '';
		  if (value === '')
		  	kriteria = "1=1";// OR PEMOHON LIKE '%" + value.toUpperCase() + "%' OR TAHUN = '"+value+"' OR PERUNTUKAN '%"+value+"%' OR NO_RENCANA LIKE '%" + value + "%'";
		  else
			  kriteria = "Status LIKE '%" + value + "%'";
		  //alert(kriteria);
		  //if (csvLayerView) {				
			  var query = new Query({
				  returnGeometry: false,
				  outFields: ["*"],
				  orderByFields: ["OBJECTID DESC"]
			  });
			  
			  query.where = kriteria;
			  menara.queryFeatures(query).then(showResults);
		  //}
	  }

	  var resultsTable = document.getElementById("tblFind");
	  
	  //Event click table pencarian
	  //---------------------------------------------------------------------------------
	  resultsTable.addEventListener('click', function(event) {
		  mapView.popup.close();
		  const rowIndex = event.target.parentNode.rowIndex;
		  
		  var rowSelected = resultsTable.getElementsByTagName('tr')[rowIndex];
		  var id = rowSelected.cells[0].innerHTML;
		  var key = rowSelected.cells[1].innerHTML;

		  const query = {
			  //objectIds: [parseInt(id)],
			  where: "OBJECTID =" + id + "",
			  outFields: ["*"],
			  returnGeometry: true
		  };
		  //console.log(query.where);

		  menara.queryFeatures(query).then(function(results) {
			  
			  mapView.graphics.removeAll();
			
			  const graphics = results.features;
			  //console.log(graphics.length);

			  const selectedGraphic = new Graphic({
				  geometry: graphics[0].geometry,
				  symbol: {
					  /*type: "simple-marker",
					  style: "solid",
					  color: "orange",
					  width: "2px", // pixels
					  outline: {
						  color: [255, 255, 0],
						  width: "2px" // points
					  }*/
					  type: "simple-marker",  // autocasts as new SimpleMarkerSymbol()
					  style: "square",
					  color: "blue",
					  size: "8px",  // pixels
					  outline: {  // autocasts as new SimpleLineSymbol()
						  color: [ 255, 255, 0 ],
						  width: 3  // points
					  }
				  }
			  });

			  mapView.graphics.add(selectedGraphic);
			  mapView.popup.open({
				  features: graphics, //results.features,
				  //featureMenuOpen: true,
				  updateLocationEnabled: true
			  });
		  })
		  .catch(errorCallback);
	  });

	  function showResults(response) {	
		
		  var results = response.features;
		
		  resultsTable.innerHTML = "";
		  
		  if (results.length === 0) {
			  document.getElementById("printResults").innerHTML = "<i>No results found</i>";
			  return;
		  }
		
		  document.getElementById("printResults").innerHTML = "Total Pengaduan : " + results.length;
		  var topRow = resultsTable.insertRow(0);
		  var cell1 = topRow.insertCell(0);
		  var cell2 = topRow.insertCell(1);
		  var cell3 = topRow.insertCell(2);
		  //var cell4 = topRow.insertCell(3);
		  //var cell5 = topRow.insertCell(4);		  
		  cell1.innerHTML = "<b>ID</b>";
		  cell2.innerHTML = "<b>Nama</b>";
		  cell3.innerHTML = "<b>Status</b>";
		  //cell4.innerHTML = "<b>Lokasi</b>";
		  //cell5.innerHTML = "<b>Resort</b>";

		  results.forEach(function(findResult, i) {
				var id = findResult.attributes.OBJECTID;
				var noruas = findResult.attributes.Nama;
				var ruas = findResult.attributes.Status;
				//var daop = findResult.attributes.Lokasi;
				//var sta = findResult.attributes.Resort;

				var row = resultsTable.insertRow(i + 1);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				//var cell4 = row.insertCell(3);
				//var cell5 = row.insertCell(4);
				cell1.innerHTML = id;
				cell2.innerHTML = noruas;
				cell3.innerHTML = ruas;
				//cell4.innerHTML = daop;
				//cell5.innerHTML = sta;
		  });
	  }

	  function rejectedPromise(error) {
		console.error("Promise didn't resolve: ", error.message);
	  }
	  
	  function doClear() {
		  resultsTable.innerHTML = "";
		  document.getElementById("printResults").innerHTML = "";
		  document.getElementById("textSearch").value = "";
		  document.getElementById("fieldSearch").value = '';
		  //document.getElementById("layerSearch").value = 'semboyan';
		  mapView.graphics.removeAll();
		  mapView.popup.close();
	  }

	  document.getElementById("findBtn").addEventListener("click", doFind);
	  //document.getElementById("clearBtn").addEventListener("click", doClear);
	  
	  function errorCallback(error) {
		console.log("error:", error);
	  }
	  
  });