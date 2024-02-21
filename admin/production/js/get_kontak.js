function get_dataSet() {
	
	var hostname = window.location.hostname;
	var origin = "http://" + hostname + "/geociamis";

	var url = origin + '/admin/production/get_kontak.php';
	
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
        //"ajax": "../../dokumen/data.txt",
        columnDefs: [{
                targets: 0,
                width: "15px",
                className: "dt-body-right"
            /*},{
                targets: 8,
                className: "text-center",
                width: "10px"
            },{
                targets: 8,
                data: null,
                defaultContent: '<button>View</button>',
                className: "text-center",
                visible: tampil*/
            }],
        columns: [
            { data: "id" },
            { data: "nama" },
            { data: "nik" },
            { data: "telp" },
            { data: "email" },
            { data: "lokasi" },
            { data: "pesan" },
            { data: "x" },
            { data: "y" }
        ]
    });
});