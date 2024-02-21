function get_dataSet() {
	
	var hostname = window.location.hostname;
	var origin = "http://" + hostname + "/ciamis";

	var url = 'admin/production/get_dokumen.php';
	
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
                targets: 4,
                visible: true
            },{
                targets: 5,
                className: "text-center",
                width: "10px"
            }],
        columns: [
            { data: "no_jembatan" },
            { data: "nama" },
            { data: "no_ruas" },
            { data: "nama_ruas" },
            { data: "kmpos" },
            { data: "panjang" },
            { data: "lebar" },
            //{ data: "bentang" },
            { 
                data: "no_jembatan",
                render: function(data, type, row){
                    return '<a href="detail_table.php?no_jembatan='+data+'" title="Detail Data">View</a>';
                }
            }
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