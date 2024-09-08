function get_dataSet() {
	
	var hostname = window.location.hostname;
	var origin = "http://" + hostname + "/ciamis";

	var url = origin + '/admin/production/get_irigasi.php?id=D.I Danasari Kiri';
	
    let result;
    $.ajax({
        async: false,
        type: 'POST',
        url: url,
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: JSON.stringify({}),
        success: function (response) {
			result = response;
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(errorThrown);
        }
    })

    return result;
}

$(document).ready(function () {
    
    let dt = get_dataSet();
    /*var _value = document.getElementById('nama').value;
    var tampil = true;
    if (_value === "")
        tampil = false;*/
    
    var table = $('#tblData').DataTable({
        data: dt,
        columnDefs: [{
                targets: 0,
                width: "15px",
                className: "text-right"
            /*},{
                targets: 7,
                className: "text-right",
                width: "20px"
            },{
                targets: 8,
                className: "text-right",
                width: "20px"*/
            },{
                targets: 7,
                className: "text-center",
                width: "10px"
            /*},{
                targets: 8,
                data: null,
                defaultContent: '<button>View</button>',
                className: "text-center",
                visible: tampil*/
            }],
        columns: [
            { data: "id" },
            { data: "nama_salur" },
            { data: "sumber_air" },
            { data: "fungsi" },
            { data: "kondisi_fi" },
            { data: "kecamatan" },
            { data: "desa" },
            //{ data: "lebar_m" },
            //{ data: "tinggi_m" },
            { 
                data: "id",
                render: function(data, type, row){
                    return '<a href="frm_irigasi.php?id='+data+'" title="Detail Data">View</a>';
                }
            }
        ]
    });
});