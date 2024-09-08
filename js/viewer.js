require([
      // ArcGIS
	  "esri/Map",
      "esri/WebMap",
	  "esri/request",
	  "esri/Basemap",
      "esri/views/MapView",
	  "esri/geometry/support/webMercatorUtils", 
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
	  "esri/layers/WMSLayer",
	  
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
	  "esri/widgets/CoordinateConversion",

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
    ], function(Map, WebMap, request, Basemap, MapView, webMercatorUtils, FeatureLayer, FindTask, FindParameters, QueryTask, Query, SimpleRenderer, LabelClass, CSVLayer, GraphicsLayer, Graphic, 
	VectorTileLayer, KMLLayer, MapImageLayer, GroupLayer, WFSLayer, WMSLayer, Home, Zoom, Compass, Search, Legend, BasemapToggle, BasemapGallery, 
	ScaleBar, Attribution, LayerList, Print, Measurement, DistanceMeasurement2D, AreaMeasurement2D, Editor, Locate, CoordinateConversion, Collapse, Dropdown, CalciteMaps, CalciteMapArcGISSupport, Memory, query) {

		var activeWidget = null,
			csvLayer,
		    csvLayerView,
			highlight;
		//var layerList;

		//url = "http://www.kav-32.com:6080/arcgis/rest/services/geospasial_ciamis/MapServer";
		var url = "http://157.10.157.37:8080/geoserver/geociamis/ows";
		var imgUrl = "https://www.kav-32.com/geociamis/foto";
		var imgIco = "http://localhost/ciamis/";

		var renBgn = {
			type: "simple",
			symbol: {
				type: "simple-marker",
				style: "square",
				color: "green",
				size: "10px",
				outline: {  
					color: "#ffffff",
					width: 1  
				}
			}
		};

		var renIrigasi = {
			type: "unique-value",  
			field: "fungsi",
			//defaultSymbol: { type: "simple-line" }, 
			uniqueValueInfos: [{
			  value: "Saluran Primer",
			  symbol: {
				type: "simple-line",  
				color: [40, 116, 166, 1.0],
				width: 1.5
			  }
			},{
				value: "Saluran Sekunder",
				symbol: {
					type: "simple-line",
					color: [231, 76, 60, 1.0],
					width: 1.5
				}
			}]
		};

		var renSal = {
			type: "simple",
			symbol: {
				type: "simple-line",
				color: [165, 105, 189],
				width: 2
			}
		};

		var renLahan = {
			type: "simple",  
			symbol: {
			  type: "simple-fill",  
			  color: [ 82, 211, 44, 0.8 ],
			  style: "diagonal-cross",
			  outline: {  
				width: 0.5,
				color: "#ffc100",			  
				style: "solid"
			  }
			}
		};

		var ren_Rumah = {
			type: "unique-value",  
			field: "serah_teri",
			//defaultSymbol: { type: "simple-line" }, 
			uniqueValueInfos: [{
			  	value: "BELUM",
			  	symbol: {
					type: "picture-marker",  // autocasts as new PictureMarkerSymbol()
					url: imgIco + "assets/img/rumah1.png",
					width: "20px",
					height: "20px"
			  	}
			},{
				value: "POTENSI",
				symbol: {
					type: "picture-marker",  // autocasts as new PictureMarkerSymbol()
					url: imgIco + "assets/img/rumah2.png",
					width: "20px",
					height: "20px"
				}
			},{
				value: "SUDAH",
				symbol: {
					type: "picture-marker",  // autocasts as new PictureMarkerSymbol()
					url: imgIco + "assets/img/rumah3.png",
					width: "20px",
					height: "20px"
				}
			}]
		};
		
		var ren_RTLH = {
			type: "simple",
		 	symbol: {
				type: "picture-marker",  // autocasts as new PictureMarkerSymbol()
				url: imgIco + "assets/img/rtlh.png",
				width: "20px",
				height: "20px"
			}
		}

		var renKP2B = {
		  type: "simple",  
		  symbol: {
			type: "simple-fill",  
			color: [ 213, 245, 227, 0.8 ],
			//style: "diagonal-cross",
			outline: {  
			  width: 0.5,
			  color: "#404040",			  
			  style: "solid"
			}
		  }
		};

		var ren_PDAM = {
			type: "simple",
		 	symbol: {
				type: "picture-marker",  // autocasts as new PictureMarkerSymbol()
				url: imgIco + "assets/img/pdam.png",
				width: "19px",
				height: "16px"
			}
		}

		var ren_Pipa = {
			type: "simple",
			symbol: {
				type: "simple-line",
				color: "#00ffff",
				width: 1,
				marker: { 
					style: "square",
					color: "#ffffff",
					placement: "end"
				}
			}
		};

		var ren_kab = {
			type: "simple",
			symbol: {
				type: "simple-line",
				color: "#ffb2ff",
				width: 1
			}
		};

		var ren_prov = {
			type: "simple",
			symbol: {
				type: "simple-line",
				color: "#ffaa00",
				width: 2
			}
		};

		var ren_nas = {
			type: "simple",
			symbol: {
				type: "simple-line",
				color: "#ff5100",
				width: 3
			}
		};

		var renA_PDAM = {
			type: "unique-value",  // autocasts as new UniqueValueRenderer()
			field: "wilpelpdam",
			//defaultSymbol: { type: "simple-fill" },  // autocasts as new SimpleFillSymbol()
			uniqueValueInfos: [{
			  value: "Bapamapurla",
			  symbol: {
				type: "simple-fill",  
				color: [5, 13, 178, 0.5],
				outline: {  
					width: 1,
					color: "#5198b5",			  
					style: "dash"
				}
			  }
			}, {
			  value: "Ciamis",
			  symbol: {
				type: "simple-fill",  
				color: [25, 250, 2, 0.5],
				outline: {  
					width: 1,
					color: "#5198b5",			  
					style: "dash"
				}
			  }
			}, {
			  value: "Cisaga",
			  symbol: {
				type: "simple-fill",  
				color: [250, 2, 2, 0.5],
				outline: {  
					width: 1,
					color: "#5198b5",			  
					style: "dash"
				}
			  }
			}, {
			  value: "Kawali",
			  symbol: {
				type: "simple-fill",  
				color: [247, 255, 0 , 0.5],
				outline: {  
					width: 1,
					color: "#5198b5",			  
					style: "dash"
				}
			  }
			},{
				value: "Panumbangan",
				symbol: {
				  type: "simple-fill",  
				  color: [203, 67, 53, 0.5],
				  outline: {  
					width: 1,
					color: "#5198b5",			  
					style: "dash"
				  }
				}
			},{
				value: "Sindangkasih",
				symbol: {
				  type: "simple-fill",  
				  color: [114, 0, 171, 0.5],
				  outline: {  
					width: 1,
					color: "#5198b5",			  
					style: "dash"
				  }
				}  
			}]
		};

		var renKel = {
			type: "simple",  
		  	symbol: {
				type: "simple-fill",  
				color: [ 194, 200, 200, 0 ],
				outline: {  
					width: 0.5,
					color: "#ffffff",			  
					style: "solid"
				}
			}
		}
	
		var renKec = {
			type: "simple",  
		  	symbol: {
				type: "simple-fill",  
				color: [ 194, 255, 204, 0.2 ],
				outline: {  
					width: 1.5,
					color: "yellow",			  
					style: "solid"
				}
			}
		}
	
		var trailheadsLabels = {
			symbol: {
			  type: "text",
			  color: "#0026FF",
			  haloColor: "#ffffff",//"#7F92FF",
			  haloSize: "2px",
			  font: {
				size: "12px",
				family: "Noto Sans",
				//style: "italic",
				weight: "bold"
			  }
			},
			labelPlacement: "above-center",
			labelExpressionInfo: {
				expression: "$feature.KECAMATAN"
			}
		};

		var lbl_rumah = {
			symbol: {
			  type: "text",
			  color: "#c0392b",
			  haloColor: "#ffffff",//"#7F92FF",
			  haloSize: "2px",
			  font: {
				size: "11px",
				family: "Noto Sans",
				//style: "italic",
				weight: "bold"
			  }
			},
			labelPlacement: "above-center",
			labelExpressionInfo: {
				expression: "$feature.nama_perus"
			}
		};

		var lbl_kel = {
			symbol: {
			  type: "text",
			  color: "#000000",
			  haloColor: "#ffffff",//"#7F92FF",
			  haloSize: "2px",
			  font: {
				size: "11px",
				family: "Noto Sans",
				//style: "italic",
				weight: "bold"
			  }
			},
			labelPlacement: "above-center",
			labelExpressionInfo: {
				expression: "$feature.wilayah__2"
			}
		};

		var lbl_bgn = {
			symbol: {
			  type: "text",
			  color: "#000000",
			  haloColor: "#ffffff",//"#7F92FF",
			  haloSize: "2px",
			  font: {
				size: "11px",
				family: "Noto Sans",
				//style: "italic",
				weight: "bold"
			  }
			},
			labelPlacement: "above-center",
			labelExpressionInfo: {
				expression: "$feature.nama_bangu"
			}
		};
	  
		function countyName(feature) {
			return feature.graphic.layer.title;
		}	  

		var temp_bgn = {
			title: "Bangunan Pelengkap",
			content: [{
				type: "fields",
				fieldInfos: [{
					fieldName: "NAMA_DI",
					label: "Nama D.I"
				},{
					fieldName: "NAMA_BANGU",
					label: "Nama Bangunan"
				},{
					fieldName: "KONTRUKSI",
					label: "Konstruksi"
				},{
					fieldName: "KONDISI_FI",
					label: "Kondisi FI"
				},{
					fieldName: "KECAMATAN",
					label: "Kecamatan"
				},{
					fieldName: "DESA",
					label: "Desa"
				},{
					fieldName: "KETERANGAN",
					label: "Keterangan"
				}]
			},{
				type: "media",
				mediaInfos: [{
					//caption: '{FOTO1}',
					type: 'image',
					value: {
						sourceURL: imgUrl + '/Irigasi/{foto1}',
						linkURL: imgUrl + '/Irigasi/{foto1}'
					}
				},{
					type: 'image',
					value: {
						sourceURL: imgUrl + '/Irigasi/{foto2}',
						linkURL: imgUrl + '/Irigasi/{foto2}'
					}
				},{
					type: 'image',
					value: {
						sourceURL: imgUrl + '/Irigasi/{foto3}',
						linkURL: imgUrl + '/Irigasi/{foto3}'
					}
				}]			
			}]
		}

		var temp_irigasi = {
			title: "Saluran Irigasi Detail",
			content: [{
				type: "fields",
				fieldInfos: [{
					fieldName: "NAMA_DI",
					label: "Nama D.I"
				},{
					fieldName: "NAMA_SALUR",
					label: "Nama Saluran"
				},{
					fieldName: "SUMBER_AIR",
					label: "Sumber Air"
				},{
					fieldName: "FUNGSI",
					label: "Fungsi"
				},{
					fieldName: "KONTRUKSI",
					label: "Konstruksi"
				},{
					fieldName: "KONDISI_FI",
					label: "Kondisi FI"
				},{
					fieldName: "TINGGI_M",
					label: "Tinggi (m)"
				},{
					fieldName: "LEBAR_M",
					label: "Lebar (m)"
				},{
					fieldName: "PANJANG_M",
					label: "Panjang (m)"
				},{
					fieldName: "KECAMATAN",
					label: "Kecamatan"
				},{
					fieldName: "DESA",
					label: "Desa"
				},{
					fieldName: "ELEVASI_1",
					label: "Elevasi"
				},{
					fieldName: "SEDIMENTAS",
					label: "Sedimentasi"
				},{
					fieldName: "KETERANGAN",
					label: "Keterangan"
				}]
			},{
				type: "media",
				mediaInfos: [{
					//caption: '{FOTO1}',
					type: 'image',
					value: {
						sourceURL: imgUrl + '/Irigasi/{foto1}',
						linkURL: imgUrl + '/Irigasi/{foto1}'
					}
				},{
					type: 'image',
					value: {
						sourceURL: imgUrl + '/Irigasi/{foto2}',
						linkURL: imgUrl + '/Irigasi/{foto2}'
					}
				},{
					type: 'image',
					value: {
						sourceURL: imgUrl + '/Irigasi/{foto3}',
						linkURL: imgUrl + '/Irigasi/{foto3}'
					}
				}]			
			}]
		}

		//----------------------------------------------------------------------------------------------
		/*var rumah = new MapImageLayer({
			url: url,
			visible: false,
			title: "Sebaran Perumahan",
			listMode: "hide-children",
			sublayers:[{
				id: 0,
				popupTemplate: {
					title: "Sebaran Perumahan",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'IMB',
							label: 'IMB'
						},{
							fieldName: 'IZIN_LINGK',
							label: 'Izin Lingkungan'
						},{
							fieldName: 'TAHUN',
							label: 'Tahun'
						},{
							fieldName: 'SITE_PLAN',
							label: 'Siteplan'
						},{
							fieldName: 'PERUSAHAAN',
							label: 'Perusahaan'
						},{
							fieldName: 'ALAMAT',
							label: 'Alamat'
						},{
							fieldName: 'PENANGGUNG',
							label: 'Penanggung Jawab'
						},{
							fieldName: 'NAMA_PERUS',
							label: 'Nama Perusahaan'
						},{
							fieldName: 'LOKASI',
							label: 'Lokasi'
						},{
							fieldName: 'KECAMATAN',
							label: 'Kecamatan'
						},{
							fieldName: 'JUMLAH_RUM',
							label: 'Jumlah Rumah'
						},{
							fieldName: 'LUAS_PERUM',
							label: 'Luas Perumahan'
						},{
							fieldName: 'KETERANGAN',
							label: 'Keterangan'
						},{
							fieldName: 'SERAH_TERI',
							label: 'Serah Terima'
						},{
							fieldName: 'Latitude',
							label: 'Latitude'
						},{
							fieldName: 'Longitude',
							label: 'Longitude'
						}]
					}],
					actions: [ {
					  title: "Data Fasum Fasos",
					  id: "edit-this",
					  className: "esri-icon-table"
					}]
				}
			}]
		});*/

		/*var rutilahu = new MapImageLayer({
			url: url,
			visible: false,
			outFields: "*",
			title: "RTLH",
			listMode: "hide-children",
			sublayers:[{
				id: 1,
				popupTemplate: {
					title: "RTLH",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'Nama',
							label: 'Nama'
						},{
							fieldName: 'Alamat',
							label: 'Alamat'
						},{
							fieldName: 'Desa',
							label: 'Desa'
						},{
							fieldName: 'Kecamatan',
							label: 'Kecamatan'
						},{
							fieldName: 'JnsKelamain',
							label: 'Jenis Kelamin'
						},{
							fieldName: 'ThnPenanga',
							label: 'Tahun Penanganan'
						},{
							fieldName: 'SumberDana',
							label: 'Sumber Dana'
						},{
							fieldName: 'Keterangan',
							label: 'Kecamatan'
						}]
					},{
						type: "media",
						mediaInfos: [{
							caption: '{Foto_RTLH}',
							type: 'image',
							value: {
								sourceURL: imgUrl + '/RTLH/{Foto_RTLH}',
								linkURL: imgUrl + '/RTLH/{Foto_RTLH}'
							}
						}]
					}]
				}
			}]
		});*/

		/*var pel_pdam = new MapImageLayer({
			url: url,
			visible: false,
			title: "Pelanggan PDAM",
			listMode: "hide-children",
			sublayers: [{
				id: 2,
				popupTemplate: {
					title: "Pelanggan PDAM",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'nama_desa',
							label: 'Desa'
						},{
							fieldName: 'nama_kec',
							label: 'Kecamatan'
						},{
							fieldName: 'layer',
							label: 'Keterangan'
						}]
					}]
				}
			}]
		});

		var pipa_pdam = new MapImageLayer({
			url: url,
			visible: false,
			title: "Pipa Distribusi PDAM",
			listMode: "hide-children",
			sublayers: [{
				id: 3,
				popupTemplate: {
					title: "Pipa Distribusi PDAM",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'jenis_pipa',
							label: 'Jenis Pipa'
						},{
							fieldName: 'dia_pipa',
							label: 'Diameter'
						},{
							fieldName: 'layer',
							label: 'Keterangan'
						}]
					}]
				}
			}]
		});

		var rel_ka = new MapImageLayer({
			url: url,
			visible: false,
			title: "Rel KA",
			listMode: "hide-children",
			sublayers: [{
				id: 4
			}]
		});

		var jalan = new MapImageLayer({
			url: url,
			visible: false,
			title: "Jaringan Jalan",
			listMode: "hide-children",
			sublayers: [{
				id: 5,
				popupTemplate: {
					title: "Jaringan Jalan",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'REMARK',
							label: 'Keterangan'
						},{
							fieldName: 'STATUS_JLN',
							label: 'Status'
						}]
					}]
				}
			}]
		});

		var area_pdam = new MapImageLayer({
			url: url,
			visible: false,
			title: "Wilayah Pelayanan PDAM",
			listMode: "hide-children",
			sublayers: [{
				id: 6,
				popupTemplate: {
					title: "Wilayah Pelayanan PDAM",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'wilpelpdam',
							label: 'Wilayah Pelayanan'
						},{
							fieldName: 'JML_PELANG',
							label: 'Jumlah Pelanggan'
						},{
							fieldName: 'desa',
							label: 'Desa'
						},{
							fieldName: 'kecamatan',
							label: 'Kecamatan'
						}]
					}]
				}
			}]
		});

		var bts_kel = new MapImageLayer({
			url : url,
			visible: false,
			title: "Batas Desa",
			listMode: "hide-children",
			sublayers: [{
				id: 7,
				popupTemplate: {
					title: "Batas Desa",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'Wilayah__2',
							label: 'Desa'
						},{
							fieldName: 'Wilayah__1',
							label: 'Kecamatan'
						}]
					}]
				}
			}]
		});

		var bts_kec = new MapImageLayer({
			url: url,
			title: "Batas Kecamatan",
			listMode: "hide-children",
			sublayers: [{
				id: 8,
				popupTemplate: {
					title: "Batas Kecamatan",
					content: [{
						type: "fields",
						fieldInfos: [{
							fieldName: 'KECAMATAN',
							label: 'KECAMATAN'
						}]
					}]
				}
			}]
		});*/
		
		var bgn_nanggela = new WFSLayer({url,
			name: "geociamis:nanggela_bangunan",
			title: "Bangunan Pelengkap",
			outFields: "*",
			renderer: renBgn,
			labelingInfo: lbl_bgn,
			popupTemplate: temp_bgn
		});
		
		var irigasi_nanggela = new WFSLayer({url,
			name: "geociamis:nanggela_irigasi_detail",
			title: "Saluran Irigasi Detail",
			outFields: "*",
			renderer: renIrigasi,
			popupTemplate: temp_irigasi
		});
		
		var sal_nanggela = new WFSLayer({url,
			name: "geociamis:nanggela_saluran",
			title: "Saluran Irigasi",
			outFields: "*",
			renderer: renSal
		});

		var lahan_nanggela = new WFSLayer({url,
			name: "geociamis:nanggela_lahan",
			title: "Lahan",
			outFields: "*",
			renderer: renLahan
		});
		
		var nanggela = new GroupLayer({
			title: "D.I Nanggela",
			visible: false,
			layers: [lahan_nanggela, sal_nanggela, irigasi_nanggela, bgn_nanggela]
		});
		
		var bgn_dankir = new WFSLayer({url,
			name: "geociamis:dankir_bangunan",
			title: "Bangunan Pelengkap",
			outFields: "*",
			renderer: renBgn,
			labelingInfo: lbl_bgn,
			popupTemplate: temp_bgn
		});
		
		var irigasi_dankir = new WFSLayer({url,
			name: "geociamis:dankir_irigasi_detail",
			title: "Saluran Irigasi Detail",
			outFields: "*",
			renderer: renIrigasi,
			popupTemplate: temp_irigasi
		});
		
		var sal_dankir = new WFSLayer({url,
			name: "geociamis:dankir_saluran",
			title: "Saluran Irigasi",
			outFields: "*",
			renderer: renSal
		});

		var lahan_dankir = new WFSLayer({url,
			name: "geociamis:dankir_lahan",
			title: "Lahan",
			outFields: "*",
			renderer: renLahan
		});
		
		var dankir = new GroupLayer({
			title: "D.I Danasari Kiri",
			visible: false,
			layers: [lahan_dankir, sal_dankir, irigasi_dankir, bgn_dankir]
		});
		
		var rumah = new WFSLayer({url,
			name: "geociamis:sebaran_perumahan",
			title: "Sebaran Perumahan",
			outFields: "*",
			visible: false,
			renderer: ren_Rumah,
			labelingInfo: lbl_rumah,
			popupTemplate: {
				title: "Sebaran Perumahan",
				content: [{
					type: "fields",
					fieldInfos: [{
						fieldName: 'IMB',
						label: 'IMB'
					},{
						fieldName: 'IZIN_LINGK',
						label: 'Izin Lingkungan'
					},{
						fieldName: 'TAHUN',
						label: 'Tahun'
					},{
						fieldName: 'SITE_PLAN',
						label: 'Siteplan'
					},{
						fieldName: 'PERUSAHAAN',
						label: 'Perusahaan'
					},{
						fieldName: 'ALAMAT',
						label: 'Alamat'
					},{
						fieldName: 'PENANGGUNG',
						label: 'Penanggung Jawab'
					},{
						fieldName: 'NAMA_PERUS',
						label: 'Nama Perusahaan'
					},{
						fieldName: 'LOKASI',
						label: 'Lokasi'
					},{
						fieldName: 'KECAMATAN',
						label: 'Kecamatan'
					},{
						fieldName: 'JUMLAH_RUM',
						label: 'Jumlah Rumah'
					},{
						fieldName: 'LUAS_PERUM',
						label: 'Luas Perumahan'
					},{
						fieldName: 'KETERANGAN',
						label: 'Keterangan'
					},{
						fieldName: 'SERAH_TERI',
						label: 'Serah Terima'
					},{
						fieldName: 'Latitude',
						label: 'Latitude'
					},{
						fieldName: 'Longitude',
						label: 'Longitude'
					}]
				}]
			}
		});
		
		var rutilahu = new WFSLayer({url,
			name: "geociamis:rtlh",
			title: "RTLH",
			outFields: "*",
			visible: false,
			renderer: ren_RTLH,
			refreshInterval: 0.1,
			popupTemplate: {
				title: "RTLH",
				content: [{
					type: "fields",
					fieldInfos: [{
						fieldName: 'Nama',
						label: 'Nama'
					},{
						fieldName: 'Alamat',
						label: 'Alamat'
					},{
						fieldName: 'Desa',
						label: 'Desa'
					},{
						fieldName: 'Kecamatan',
						label: 'Kecamatan'
					},{
						fieldName: 'JnsKelamain',
						label: 'Jenis Kelamin'
					},{
						fieldName: 'ThnPenanga',
						label: 'Tahun Penanganan'
					},{
						fieldName: 'SumberDana',
						label: 'Sumber Dana'
					},{
						fieldName: 'Keterangan',
						label: 'Kecamatan'
					}]
				},{
					type: "media",
					mediaInfos: [{
						//caption: '{FOTO1}',
						type: 'image',
						value: {
							sourceURL: imgUrl + '/RTLH/{FOTO1}',
							linkURL: imgUrl + '/RTLH/{FOTO1}'
						}
					},{
						type: 'image',
						value: {
							sourceURL: imgUrl + '/RTLH/{FOTO2}',
							linkURL: imgUrl + '/RTLH/{FOTO2}'
						}
					},{
						type: 'image',
						value: {
							sourceURL: imgUrl + '/RTLH/{FOTO3}',
							linkURL: imgUrl + '/RTLH/{FOTO3}'
						}
					}]
				}]
			}
		});

		var lp2b = new WFSLayer({
			url,
			name: "geociamis:lp2b",
			title: "LP2B",
			visible: false,
			renderer: renKP2B
		});

		var pel_pdam = new WFSLayer({url,
			name: "geociamis:pelanggan_pdam",
			title: "Pelanggan PDAM",
			visible: false,
			renderer: ren_PDAM
		});

		var pipa_pdam = new WFSLayer({url,
			name: "geociamis:pipa_distribusi_pdam",
			title: "Pipa Distribusi PDAM",
			visible: false,
			renderer: ren_Pipa
		});

		var jln_kab = new WFSLayer({url,
			name: "geociamis:jalan_kabupaten",
			title: "Jalan Kabupaten",
			renderer: ren_kab			
		}); 

		var jln_prov = new WFSLayer({url,
			name: "geociamis:jalan_provinsi",
			title: "Jalan Provinsi",
			renderer: ren_prov		
		}); 

		var jln_nas = new WFSLayer({url,
			name: "geociamis:jalan_nasional",
			title: "Jalan Nasional",
			renderer: ren_nas		
		}); 

		var jalan = new GroupLayer({
			title: "Jaringan Jalan",
			visible: false,
			layers: [jln_nas, jln_prov, jln_kab]
		});

		var area_pdam = new WFSLayer({url,
			name: "geociamis:wilayah_pelayanan_PDAM",
			title: "Wilayah Pelayanan PDAM",
			visible: false,
			renderer: renA_PDAM
		});

		var bts_kel = new WFSLayer({url,
			name: "geociamis:batas_desa",
			title: "Batas Desa",
			outFields: "*",
			visible: false,
			renderer: renKel,
			labelingInfo: lbl_kel
		});
		
		var bts_kec = new WFSLayer({url,
			name: "geociamis:batas_kecamatan",
			title: "Batas Kecamatan",
			outFields: ["*"],
			visible: true,
			renderer: renKec,
			popupEnabled: true,
			labelingInfo: [trailheadsLabels]
		});
	  
		var map = new Map({
			basemap: "satellite",
			//layers: [bts_kec, bts_kel, area_pdam, jalan, rel_ka, pipa_pdam, pel_pdam, rutilahu, rumah]
			layers: [bts_kec, bts_kel, area_pdam, jalan, pipa_pdam, pel_pdam, lp2b, rutilahu, rumah, dankir, nanggela]
		});
	        
		var mapView = new MapView({
			container: "mapViewDiv",
			map: map,
			center: [108.3819775, -7.2593733],
			zoom: 12,
			padding: {
			  top: 50,
			  bottom: 0
			},
			showLabels: true,
			ui: {components: []}
		});

		function viewFasumFasos() {
			var id = view.popup.selectedFeature.attributes.No_;

			var params = "no="+id;
			var result, s = '<table class=table table-striped>';

			var xhr = new XMLHttpRequest();
			xhr.open("POST", "../admin/production/get_fasumfasos.php", true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.setRequestHeader("Content-length", params.length);
			
			xhr.onload = function () {			
				result = JSON.parse(xhr.responseText);
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

		/*reactiveUtils.on(
		  () => view.popup,
		  "trigger-action",
		  (event) => {  // Execute the measureThis() function if the measure-this action is clicked
			if (event.action.id === "edit-this") {
			  viewFasumFasos();
			} 
		});*/
		mapView.popup.on("trigger-action", function(event) {
			if (event.action.id === "measure-this") {
				viewFasumFasos();				
			}
		});

		mapView.on("pointer-move", function(evt) {
			var x, y;
			var point = mapView.toMap(evt);
			var mp = webMercatorUtils.webMercatorToGeographic(point);
            x = mp.x.toFixed(7);
            y = mp.y.toFixed(7);

			document.getElementById('lblKoordinat').innerHTML = x + ', ' + y + '&nbsp;&nbsp;';
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
			nextBasemap: "topo"
		});
		mapView.ui.add(basemapToggle, "bottom-right");          
      
		var scaleBar = new ScaleBar({
			view: mapView,
			style: "ruler",
			unit: 'metric'
		});
		mapView.ui.add(scaleBar, "bottom-right");

		var attribution = new Attribution({
			view: mapView,
			visible: false
		});
		mapView.ui.add(attribution, "manual");

		var legendWidget = new Legend({
			//container: "legendDiv",
			view: mapView
		});
		mapView.ui.add(legendWidget, "bottom-left");
	  
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
		
			if (item.title === "Batas Kecamatan" || item.title === "Batas Desa" || item.title === "Wilayah Pelayanan PDAM" || item.title === "Jalan Nasional" || item.title === "Jalan Provinsi" || item.title === "Jalan Kabupaten" || item.title === "LP2B" || item.title === "Pipa Distribusi PDAM" || item.title === "Pelanggan PDAM" || item.title === "RTLH" || item.title === "Sebaran Perumahan" || item.title === "Lahan" || item.title === "Saluran Irigasi" || item.title === "Saluran Irigasi Detail" || item.title === "Bangunan Pelengkap") {
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

			/*if (item.children.items.length !== 0) {

				let childrenArr = item.children.items
				for (let i = 0; i < childrenArr.length; i++) {
					request(childrenArr[i].layer.url.slice(0, -1) + "legend", {
						query: {
							f: 'json'
						},
						responseType: "json"
					}).then(function (response) {
						let img = document.createElement("img");
						console.log(childrenArr[i].layer.url + "/images/" + response.data
						.layers[i].legend[0].url);
						img.src = childrenArr[i].layer.url + "/images/" + response.data
							.layers[i].legend[0].url;

						childrenArr[i].panel = {
							content: img,
							open: false
						}
					});
				}
			}*/
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
				container: "basemapDiv",
				source: [Basemap.fromId("satellite"), Basemap.fromId("hybrid"), Basemap.fromId("topo-vector"), Basemap.fromId("osm")]
			});
		
			var layerList = new LayerList({
				container: "layerDiv",
				view: mapView,
				listItemCreatedFunction: defineActions
			});

			layerList.on("trigger-action", function(event) {
				var visibleLayer = bts_kec;
				if (event.item.title === "Batas Kecamatan")
					visibleLayer = bts_kec;
				else if (event.item.title === "Batas Desa")
					visibleLayer = bts_desa;
				else if (event.item.title === "Wilayah Pelayanan PDAM")
					visibleLayer = area_pdam;
				else if (event.item.title === "Jalan Nasional")
					visibleLayer = jln_nas;
				else if (event.item.title === "Jalan Provinsi")
					visibleLayer = jln_prov;
				else if (event.item.title === "Jalan Kabupaten")
					visibleLayer = jln_kab;
				else if (event.item.title === "LP2B")
					visibleLayer = kp2b;
				else if (event.item.title === "Pipa Distribusi PDAM")
					visibleLayer = pipa_pdam;
				else if (event.item.title === "Pelanggan PDAM")
					visibleLayer = pel_pdam;
				else if (event.item.title === "RTLH")
					visibleLayer = rutilahu;
				else if (event.item.title === "Sebaran Perumahan")
					visibleLayer = rumah;
				else if (event.item.title === "Lahan") {
					if (event.item.parentNode.title === "D.I Nanggela")
						visibleLayer = lahan_nanggela;
					else
						visibleLayer = lahan_dankir;
				}
				else if (event.item.title === "Saluran Irigasi") {
					if (event.item.parentNode.title === "D.I Nanggela")
						visibleLayer = sal_nanggela;
					else
						visibleLayer = sal_dankir;
				}
				else if (event.item.title === "Saluran Irigasi Detail") {
					if (event.item.parentNode.title === "D.I Nanggela")
						visibleLayer = irigasi_nanggela;
					else
						visibleLayer = irigasi_dankir;
				}
				else if (event.item.title === "Bangunan Pelengkap") {
					if (event.item.parentNode.title === "D.I Nanggela")
						visibleLayer = bgn_nanggela;
					else
						visibleLayer = bgn_dankir;
				}
			  
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
			  
			//mapView.ui.add(layerList, "top-right");
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