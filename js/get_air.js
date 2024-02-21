function get_dataSet() {
	
	var hostname = window.location.hostname;
	var origin = "http://" + hostname + "/ciamis";

	var url = 'admin/production/get_air.php';
	
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
    
    $('#tblData').DataTable({
        data: dt,
        //"ajax": "./dokumen/data.txt",
        columnDefs: [{
                targets: 0,
                width: "15px",
                className: "dt-body-right"
            },{
                targets: 3,
                className: "dt-body-right"
            },{
                targets: 5,
                className: "text-center",
                width: "10px"
            },{
                targets: 6,
                className: "dt-body-right"
            }],
        columns: [
            { data: "id" },
            { data: "desa" },
            { data: "kecamatan" },
            { data: "jumlah_sr" },
            { data: "keterangan" },
            { data: "thn_anggaran" },
            { data: "anggaran" }
        ]
    });

    var table = $('#tblData').DataTable();

    $('#tblData tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    function format(d) {
        return (d[0]['NO']);
    }

    $('#btnAdd').click(function () {
        //alert(format(table.rows('.selected').data()));
        window.location="document_frm.php?id="
    });

    $('#btnEdit').click(function () {
        if (table.rows('.selected').data().length == 0)
            alert('Pilih salah satu baris data !')
        else
            alert(format(table.rows('.selected').data()));
    });

    $('#btnDel').click(function () {
        if (table.rows('.selected').data().length == 0)
            alert('Pilih salah satu baris data !')
        else
            alert(format(table.rows('.selected').data()));
    });
});