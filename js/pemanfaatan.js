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
	  "esri/layers/WFSLayer",
	  
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
      "dojo/domReady!"
    ], function(Map, WebMap, MapView, FeatureLayer, FindTask, FindParameters, QueryTask, Query, SimpleRenderer, LabelClass, CSVLayer, GraphicsLayer, Graphic, 
	VectorTileLayer, KMLLayer, MapImageLayer, GroupLayer, WFSLayer, Home, Zoom, Compass, Search, Legend, BasemapToggle, BasemapGallery, 
	ScaleBar, Attribution, LayerList, Print, Measurement, DistanceMeasurement2D, AreaMeasurement2D, Editor, Locate, Collapse, Dropdown, CalciteMaps, CalciteMapArcGISSupport, Memory) {

		var activeWidget = null,
			csvLayer,
		    csvLayerView,
			highlight;

		var renderer = {
				type: "simple",  // autocasts as new SimpleRenderer()
				symbol: {
				  type: "simple-fill",  // autocasts as new SimpleFillSymbol()
				  color: [ 255, 128, 0, 0 ],
				  outline: {  // autocasts as new SimpleLineSymbol()
					width: 1.0,
					color: "#404040",			  
					style: "dash"
				  }
				}
			  };
		  
		var renTower = {
				type: "simple",  // autocasts as new SimpleRenderer()
				symbol: {
				  type: "simple-marker",  // autocasts as new SimpleFillSymbol()
				  color: "yellow",//[ 255, 128, 0, 1 ],
				  size: 9,
				  outline: {  // autocasts as new SimpleLineSymbol()
					width: 1.0,
					color: "#404040",			  
					style: "solid"
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
				expression: "$feature.DESA"
			}
		};
	  
		var renMarket = {
			type: "unique-value",
			field: "STATUS",
			defaultSymbol: { type: "simple-marker", size: 9 },  
			defaultLabel: "Lainnya",
			uniqueValueInfos: [{
				value: "Berizin",
				symbol: {
					type: "simple-marker",  // autocasts as new SimpleFillSymbol()
					color: "blue",
					size: 9
				}
			}, {
				// All features with value of "East" will be green
				value: "Berizin (Izin Prinsip)",
				symbol: {
					type: "simple-marker",  // autocasts as new SimpleFillSymbol()
					color: "green",
					size: 9
				}
			}, {
				// All features with value of "South" will be red
				value: "Tidak Berizin",
				symbol: {
					type: "simple-marker",  // autocasts as new SimpleFillSymbol()
					color: "red",
					size: 9
				}
			}]
		}
	  
		function countyName(feature) {
			return feature.graphic.layer.title;
		}
	  
		var imgUrl = "http://www.kav-32.com/sitarung/foto/";
		var template = {
			title: countyName,
			content: [{
				type: "fields",
				fieldInfos: [{
					fieldName: "TOPONIM",
					label: "Toponimi"
				},
				{
					fieldName: "JENIS",
					label: "Fungsi"
				},
				{
					fieldName: "JENIS_UTAM",
					label: "Jenis"
				}]
			},{
				type: "media",
				mediaInfos: [{
					title: 'Foto',
					caption: '{FOTO}',
					type: 'image',
					value: {
						sourceURL: imgUrl + '{FOTO}.jpg',
						linkURL: imgUrl + '{FOTO}.jpg'
					}
				}]
			}]
		};
	  
		template = {
			title: countyName,
			content: [{
				type: "fields",
				fieldInfos: [{
					fieldName: "NO_DOKUMEN",
					label: "No Dokumen"
				},
				{
					fieldName: "ID_SITE",
					label: "ID Site"
				},
				{
					fieldName: "NAMA_SITE",
					label: "Nama Site"
				},
				{
					fieldName: "ALAMAT_LOK",
					label: "Alamat"
				},
				{
					fieldName: "KELURAHAN",
					label: "Kelurahan"
				},
				{
					fieldName: "KECAMATAN",
					label: "Kecamatan"
				},
				{
					fieldName: "KAB_KOTA",
					label: "Kab/Kota"
				},
				{
					fieldName: "PEMILIK_ME",
					label: "Pemilik"
				},
				{
					fieldName: "OPERATOR",
					label: "Operator"
				},
				{
					fieldName: "LATDESIMAL",
					label: "Latitude"
				},
				{
					fieldName: "LONGDESIMA",
					label: "Longitude"
				},
				{
					fieldName: "ALTITUDE",
					label: "Altitude"
				},
				{
					fieldName: "JUMLAH_ANT",
					label: "Jumlah Antena"
				},
				{
					fieldName: "TINGGI_ANT",
					label: "Tinggi Antena"
				},
				{
					fieldName: "KATEGORI",
					label: "Kategori"
				}]
			}]
		};
		
		/*url = "http://www.kav-32.com/arcgis/rest/services/SITARUNG/MapServer/1";
		var menara = new FeatureLayer({url,
			title: "MENARA",
			outFields: ["*"],
			visible: true,
			popupEnabled: true,
			popupTemplate: template
		});*/
		var menara = new WFSLayer({
			url: "https://geoserver.cimahikota.go.id/geoserver/sitarung/ows", 
			name: "sitarung:tower",
			title: "MENARA",
			outFields: ["*"],
			visible: true,
			renderer: renTower,
			popupEnabled: true,
			popupTemplate: template
		});

		template = {
			title: countyName,
			content: [{
				type: "fields",
				fieldInfos: [{
					fieldName: "NO",
					label: "No"
				},
				{
					fieldName: "NAMA_PEMIL",
					label: "Nama Pemilik"
				},
				{
					fieldName: "NAMA_PERUS",
					label: "Nama Perusahaan"
				},
				{
					fieldName: "BENTUK_PER",
					label: "Bentuk Perusahaan"
				},
				{
					fieldName: "ALAMAT_PER",
					label: "Alamat Perusahaan"
				},
				{
					fieldName: "KELURAHAN",
					label: "Kelurahan"
				},
				{
					fieldName: "KECAMATAN",
					label: "Kecamatan"
				},
				{
					fieldName: "MASA_BERLA",
					label: "Masa Berlaku"
				},
				{
					fieldName: "KETERANGAN",
					label: "Keterangan"
				},
				{
					fieldName: "X",
					label: "Longitude"
				},
				{
					fieldName: "Y",
					label: "Latitude"
				},
				{
					fieldName: "STATUS",
					label: "Status"
				}]
			}]
		};

		var minimarket = new WFSLayer({
			url: "https://geoserver.cimahikota.go.id/geoserver/sitarung/ows", 
			name: "sitarung:minimarket",
			title: "MINIMARKET",
			outFields: ["*"],
			visible: true,
			renderer: renMarket,
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
		
		/*url = "http://www.kav-32.com/arcgis/rest/services/SITARUNG/MapServer/8";
		var bts_kec = new FeatureLayer({url,
			title: "BATAS ADMINISTRASI",
			outFields: ["*"],
			visible: true,
			popupEnabled: true,
			popupTemplate: template
		});*/
		var bts_kec = new WFSLayer({
			url: "https://geoserver.cimahikota.go.id/geoserver/sitarung/ows", 
			name: "sitarung:BATAS_ADMINISTRASI",
			title: "BATAS ADMINISTRASI",
			outFields: ["*"],
			visible: true,
			renderer: renderer,
			labelingInfo: trailheadsLabels, 
			popupEnabled: true,
			popupTemplate: template
		});
	  	  
		//------------------------------------------------------------------------------------------
		var url = "http://www.kav-32.com/arcgis/rest/services/sitarung_rencana/MapServer";
		var url_silaja = "http://www.kav-32.com/arcgis/rest/services/silaja/MapServer";

		var teknis = new MapImageLayer({
			url: url,
			title: "Pertimbangan Teknis",
			listMode: "hide-children",
			sublayers: [{
				id: 0
			}]
		});

		var pola_ruang = new MapImageLayer({
			url : url,
			title: "Pola Ruang",
			legendEnabled: true,
			sublayers: [{
				id: 37,
				title: "Permukiman",
				visible: true,
				popupTemplate: {
					title: "Kawasan Permukiman",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "Permukiman",
							label: "Keterangan"
						}]
					}]
				}
			},{
				id: 36,
				title: "Sosial Budaya",
				popupTemplate: {
					title: "Sosial Budaya",
					content: [{
						type: 'field',
						fieldInfos: [{
							fieldName: "Keterangan",
							label: "Keterangan"
						},{
							fieldName: "Wilayah",
							label: "Wilayah"
						}]
					}]
				}
			},{
				id: 35,
				title: "Industri 2",
				popupTemplate: {
					title: "Kawasan Militer",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "REGUNAL",
							label: "Keterangan"
						},{
							fieldName: "Luas_Wilay",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						}]
					}]
				}
			},{
				id: 34,
				title: "Industri",
				popupTemplate: {
					title: "Industri",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "REGUNAL",
							label: "Keterangan"
						},{
							fieldName: "Luas_Wilay",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						}]
					}]
				}
			},{
				id: 32,
				title: "Kawasan Perikanan"
			},{
				id: 31,
				title: "Kawasan Militer",
				popupTemplate: {
					title: "Kawasan Perkantoran dan Sosial",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "REGUNAL",
							label: "Keterangan"
						},{
							fieldName: "Luas_Wilay",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						}]
					}]
				}
			},{
				id: 30,
				title: "Perkantoran dan Sosial",
				popupTemplate: {
					title: "Perkantoran dan Sosial",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "KET",
							label: "Keterangan"
						},{
							fieldName: "LUAS",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						}]
					}]
				}
			},{
				id: 29,
				title: "Kawasan Perdagangan",
				popupTemplate: {
					title: "Kawasan Perdagangan",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "KAW_STRATE",
							label: "Kawasan Strategis"
						},{
							fieldName: "AREA",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						}]
					}]
				}
			},{
				id: 28,
				title: "Kawasan Resapan Air",
				popupTemplate: {
					title: "Kawasan Resapan Air",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "Keterangan",
							label: "Keterangan"
						},{
							fieldName: "Wilayah",
							label: "Wilayah"
						}]
					}]
				}
			},{
				id: 27,
				title: "Rawan Aliran Lahar",
				popupTemplate: {
					title: "Rawan Aliran Lahar",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "AREA",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						},{
							fieldName: "KETERANGAN",
							label: "Keterangan"
						}]
					}]
				}
			},{
				id: 26,
				title: "Kawasan Bandung Utara",
				popupTemplate: {
					title: "Kawasan Bandung Utara",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "KET",
							label: "Keterangan"
						},{
							fieldName: "AREA",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						},{
							fieldName: "PERIMETER",
							label: "Perimeter",
							format: {
								places: 2,
								digitSeparator: true
							}
						}]
					}]
				}
			},{
				id: 25,
				title: "Sempadan Jalur KA",
				popupTemplate: {
					title: "Sempadan Jalur KA",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "KET",
							label: "Keterangan"
						},{
							fieldName: "LUAS",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						},{
							fieldName: "KELURAHAN",
							label: "Kelurahan"
						},{
							fieldName: "KECAMATAN",
							label: "Kecamatan"
						}]
					}]
				}
			},{
				id: 24,
				title: "Sempadan TOL",
				popupTemplate: {
					title: "Sempadan TOL",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "KET",
							label: "Keterangan"
						},{
							fieldName: "LUAS",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						},{
							fieldName: "KELURAHAN",
							label: "Kelurahan"
						},{
							fieldName: "KECAMATAN",
							label: "Kecamatan"
						}]
					}]
				}
			},{
				id: 23,
				title: "Sempadan Sungai"
			},{
				id: 22,
				title: "RTH",
				popupTemplate: {
					title: "RTH",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "KET",
							label: "Keterangan"
						},{
							fieldName: "Luas",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						},{
							fieldName: "KELURAHAN",
							label: "Kelurahan"
						},{
							fieldName: "KECAMATAN",
							label: "Kecamatan"
						}]
					}]
				}
			},{
				id: 21,
				title: "Sempadan Sutet",
				popupTemplate: {
					title: "Sempadan Sutet",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "KELURAHAN",
							label: "Kelurahan"
						},{
							fieldName: "KECAMATAN",
							label: "Kecamatan"
						},{
							fieldName: "LUAS",
							label: "Luas",
							format: {
								places: 2,
								digitSeparator: true
							}
						}]
					}]
				}
			},{
				id: 20,
				title: "Rawan Bencana",
				visible: true,
				popupTemplate: {
					title: "Rawan Bencana",
					content: [{
						type: 'fields',
						fieldInfos: [{
							fieldName: "Jenis",
							label: "Jenis"
						}]
					}]
				}
			},{
				id: 19,
				title: "Embung",
				visible: true
			},{
				id: 18,
				title: "Ruang Evakuasi",
				visible: true
			}]
		});

		var bts = new MapImageLayer({
			url : url,
			title: "Batas Administrasi",
			legendEnabled: true,
			sublayers: [{
				id: 43,
				title: "Batas Kecamatan",
				visible: true
			},{
				id: 42,
				title: "Batas Kelurahan",
				visible: true
			}]
		});

		var jj = new MapImageLayer({
			url: url_silaja,
			title: "Jalan & Jembatan",
			visible: false,
			sublayers: [{
				id: 2,
				title: "Jembatan",
				popupTemplate: {
					title: "Jembatan",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: "Nama",
							label: "Nama Jembatan"
						},{
							fieldName: "TOPONIM",
							label: "Nama Jalan"
						},{
							fieldName: "Kab_Kota",
							label: "Kab/Kota"
						},{
							fieldName: "Jmlh_Btng",
							label: "Jumlah Bentang"
						},{
							fieldName: "Nilai_BA",
							label: "Nilai BA"
						},{
							fieldName: "Nilai_LNT",
							label: "Nilai LNT"
						},{
							fieldName: "Nilai_BB",
							label: "Nilai BB"
						},{
							fieldName: "Nilai_DAS",
							label: "Nilai DAS"
						},{
							fieldName: "Nilai_JBT",
							label: "Nilai JBT"
						},{
							fieldName: "Penanganan",
							label: "Penanganan"
						},{
							fieldName: "Kls_Jmbt",
							label: "Kelas Jembatan"
						},{
							fieldName: "Panjang",
							label: "Panjang"
						},{
							fieldName: "L_Jembatan",
							label: "Lebar Jembatan"
						},{
							fieldName: "L_Jalan",
							label: "Lebar Jalan"
						},{
							fieldName: "No_Jmbt",
							label: "No Jembatan"
						}]
					}]
				}
			},{
				id: 1,
				title: "Jalan",
				popupTemplate: {
					title: "Jalan",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: "TOPONIM",
							label: "Nama Jalan"
						},
						{
							fieldName: "Tahun",
							label: "Tahun"
						},
						{
							fieldName: "Fungsi_Jln",
							label: "Fungsi Jalan"			
						},
						{
							fieldName: "Status_Jln",
							label: "Status Jalan"			
						},
						{
							fieldName: "No_Ruas",
							label: "No Ruas"			
						},
						{
							fieldName: "Panjang_m",
							label: "Panjang (m)"			
						},
						{
							fieldName: "Lebar_m",
							label: "Lebar (m)"			
						},
						{
							fieldName: "Kondsi_Jln",
							label: "Kondisi Jalan"			
						},
						{
							fieldName: "Jns_Perker",
							label: "Jenis Perker"			
						},
						{
							fieldName: "Wilayah",
							label: "Wilayah"			
						}],
					}]
				}
			}]
		});
	  
		var map = new Map({
			basemap: "topo",
			layers: [bts, pola_ruang, teknis, jj]
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
				
		function measureThis() {
			let nama_paket = mapView.popup.selectedFeature.attributes.paket;
			var params = "nama_paket="+nama_paket;
			var result, s = '<table class=table table-striped>';

			var xhr = new XMLHttpRequest();
			xhr.open("POST", "http://phln.ceteo.co.id/api/get_packet_detail", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.setRequestHeader("Content-length", params.length);
			
			xhr.onload = function () {			
				result = JSON.parse(xhr.responseText);
				//alert(result.rows[0]);
				if (result.rows === 1) {
					var rp = parseFloat(result.data[0].nilai_kontrak);
					rp = rp || 0;
					var kontraktor = result.data[0].penyedia_jasa;
					kontraktor = kontraktor || '-';
					var rea = parseFloat(result.data[0].realisasi_kinerja_fisik);
					var ren = parseFloat(result.data[0].realisasi_keuangan);
					var url = result.data[0].report_url;
					
					s = s + '<tr><td width=135px>Nama Kegiatan</td><td>:</td><td>' + result.data[0].nama_kegiatan + '</td></tr>';
					s = s + '<tr><td>Nama Paket</td><td>:</td><td>' + result.data[0].nama_paket + '</td></tr>';
					s = s + '<tr><td>Nilai Kontrak</td><td>:</td><td>' + (rp).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</td></tr>';
					s = s + '<tr><td>Penyedia Jasa</td><td>:</td><td>' + kontraktor + '</td></tr>';
					s = s + '<tr><td>Realisasi Keuangan</td><td>:</td><td>' + (ren).toFixed(2) + '</td></tr>';
					s = s + '<tr><td>Realisasi Kinerja Fisik</td><td>:</td><td>' + (rea).toFixed(2) + ' % </td></tr>';
					s = s + '<tr><td>URL Report</td><td>:</td><td><a href=' + url + ' target=blank>' + url + '</a></td></tr>';
				} else {
					s = s + '<tr><td>Tidak ada detail data !</td></tr>';
				}
				s = s + '</table>';
				mapView.popup.content = s;
			};
			xhr.send(params);
		}

		mapView.popup.on("trigger-action", function(event) {
			if (event.action.id === "measure-this") {
				measureThis();				
			}
		});

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
      
		var basemapToggle = new BasemapToggle({
			view: mapView,
			secondBasemap: "satellite"
		});
		mapView.ui.add(basemapToggle, "bottom-right");          
      
		var scaleBar = new ScaleBar({
			view: mapView,
			style: "ruler",
			unit: "metric"
		});
		mapView.ui.add(scaleBar, "bottom-left");

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
					open: false
				};
				}
		
			if (item.title === "Batas Kecamatan" || item.title === "Batas Kelurahan" || item.title === "Pertimbangan Teknis" || item.title === "Jalan" || item.title === "Jembatan") {
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
				// specify your own print service
				printServiceUrl:
				  "https://utility.arcgisonline.com/arcgis/rest/services/Utilities/PrintingTools/GPServer/Export%20Web%20Map%20Task"
        	});

          	// Add widget to the top right corner of the view
          	
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
				var visibleLayer = bts_kec;
				if (event.item.title === "MENARA")
					visibleLayer = menara;				
				else if (event.item.title === "MINIMARKET")
					visibleLayer = minimarket;
			
				var id = event.action.id;
	
				if (id === "full-extent") {
					mapView.goTo(visibleLayer.fullExtent);
				} else if (id === "information") {
					window.open(visibleLayer.url);
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

			mapView.ui.add(layerList, "top-right");
   		});

		// Add KML Layer start here

		const portalUrl = "https://www.arcgis.com";

		document.getElementById("uploadForm").addEventListener("change", (event) => {
			const fileName = event.target.value.toLowerCase();

			if (fileName.indexOf(".zip") !== -1) {//is file a zip - if not notify user
				generateFeatureCollection(fileName);
			}
			else {
				document.getElementById('upload-status').innerHTML = '<p style="color:red">Add shapefile as .zip file</p>';
			}
		});

        function generateFeatureCollection (fileName) {
            let name = fileName.split(".");
            // Chrome adds c:\fakepath to the value - we need to remove it
            name = name[0].replace("c:\\fakepath\\", "");

            document.getElementById('upload-status').innerHTML = '<b>Loading </b>' + name;

            // define the input params for generate see the rest doc for details
            // https://developers.arcgis.com/rest/users-groups-and-items/generate.htm
            const params = {
              'name': name,
              'targetSR': mapView.spatialReference,
              'maxRecordCount': 10000,
              'enforceInputFileSizeLimit': true,
              'enforceOutputJsonSizeLimit': true
            };

            // generalize features to 10 meters for better performance
            params.generalize = true;
            params.maxAllowableOffset = 10;
            params.reducePrecision = true;
            params.numberOfDigitsAfterDecimal = 0;

            const myContent = {
              'filetype': 'shapefile',
              'publishParameters': JSON.stringify(params),
              'f': 'json',
            };

            // use the REST generate operation to generate a feature collection from the zipped shapefile
            request(portalUrl + '/sharing/rest/content/features/generate', {
              query: myContent,
              body: document.getElementById('uploadForm'),
              responseType: 'json'
            })
            .then((response) => {
                const layerName = response.data.featureCollection.layers[0].layerDefinition.name;
                document.getElementById('upload-status').innerHTML = '<b>Loaded: </b>' + layerName;
                addShapefileToMap(response.data.featureCollection);
              })
              .catch(errorHandler);
            }

		function errorHandler (error) {
			document.getElementById('upload-status').innerHTML =
			"<p style='color:red;max-width: 500px;'>" + error.message + "</p>";
		}

        function addShapefileToMap (featureCollection) {
            // add the shapefile to the map and zoom to the feature collection extent
            // if you want to persist the feature collection when you reload browser, you could store the
            // collection in local storage by serializing the layer using featureLayer.toJson()
            // see the 'Feature Collection in Local Storage' sample for an example of how to work with local storage
            let sourceGraphics = [];

            const layers = featureCollection.layers.map((layer) => {

              const graphics = layer.featureSet.features.map((feature) => {
                return Graphic.fromJSON(feature);
              })
              sourceGraphics = sourceGraphics.concat(graphics);
              const featureLayer = new FeatureLayer({
                objectIdField: "FID",
                source: graphics,
                fields: layer.layerDefinition.fields.map((field) => {
                return Field.fromJSON(field);
                })
              });
              return featureLayer;
              // associate the feature with the popup on click to enable highlight and zoom to
            });
            map.addMany(layers);
            mapView.goTo(sourceGraphics)
            .catch((error) => {
              if (error.name != "AbortError"){
                console.error(error);
              }
            });

            document.getElementById('upload-status').innerHTML = "";
        }

		// Add KML Layer end here
		
        function doFind() {
			//var lyr = document.getElementById("layerSearch").value;
			//var field = document.getElementById("fieldSearch").value;
			var value = document.getElementById("textSearch").value;
						
			//csvLayerView = site;
			
			var kriteria = '';
			/*if (field === 'fl')
				kriteria = "FL LIKE '%" + value + "%' or FL LIKE '%" + value.toUpperCase() + "%' or Func_Loc_Description LIKE '%" + value + "%' or Func_Loc_Description LIKE '%" + value.toUpperCase() + "%'";
			else
				kriteria = field + " LIKE '%" + value + "%'";*/
			kriteria = "PEMOHON LIKE '%" + value + "%'";// OR PEMOHON LIKE '%" + value.toUpperCase() + "%' OR TAHUN = '"+value+"' OR PERUNTUKAN '%"+value+"%' OR NO_RENCANA LIKE '%" + value + "%'";
			//alert(kriteria);
			//if (csvLayerView) {				
				var query = new Query({
					returnGeometry: false,
					outFields: ["*"]
				});
				
				query.where = kriteria;
				site.queryFeatures(query).then(showResults);
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
				where: "PEMOHON LIKE '%" + key + "%'",
				outFields: ["*"],
				returnGeometry: true
			};
			//console.log(query.where);

			site.queryFeatures(query).then(function(results) {
				
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
		  
			/*mapView.goTo(results).then(function() {
				mapView.popup.open({
					features: results,
					//featureMenuOpen: true,
					updateLocationEnabled: true
				});
			});*/

			document.getElementById("printResults").innerHTML = results.length + " results found!";
			var topRow = resultsTable.insertRow(0);
			var cell1 = topRow.insertCell(0);
			var cell2 = topRow.insertCell(1);
			var cell3 = topRow.insertCell(2);
			var cell4 = topRow.insertCell(3);
			//var cell5 = topRow.insertCell(4);		  
			cell1.innerHTML = "<b>ID</b>";
			cell2.innerHTML = "<b>Pemohon</b>";
			cell3.innerHTML = "<b>Tahun</b>";
			cell4.innerHTML = "<b>Peruntukan</b>";
			//cell5.innerHTML = "<b>Resort</b>";

			results.forEach(function(findResult, i) {
				/*if (csvLayerView.title === 'PATOK KMHM') {
					var id = findResult.attributes.OBJECTID;
					var noruas = findResult.attributes.KD_KMHM;
					var ruas = findResult.attributes.X;
					var sta = findResult.attributes.Y;
				} else {*/
					var id = findResult.attributes.FID;
					var noruas = findResult.attributes.PEMOHON;
					var ruas = findResult.attributes.TAHUN;
					var daop = findResult.attributes.PERUNTUKAN;
					//var sta = findResult.attributes.Resort;
				//}

				var row = resultsTable.insertRow(i + 1);
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				//var cell5 = row.insertCell(4);
				cell1.innerHTML = id;
				cell2.innerHTML = noruas;
				cell3.innerHTML = ruas;
				cell4.innerHTML = daop;
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
			//document.getElementById("fieldSearch").value = 'fl';
			//document.getElementById("layerSearch").value = 'semboyan';
			mapView.graphics.removeAll();
			mapView.popup.close();
		}

        document.getElementById("findBtn").addEventListener("click", doFind);
		document.getElementById("clearBtn").addEventListener("click", doClear);
		
		function errorCallback(error) {
          console.log("error:", error);
        }
    });