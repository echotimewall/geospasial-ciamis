function get_dataSet() {
	
	var hostname = window.location.hostname;
	var origin = "http://" + hostname + "/geociamis";

	var url = origin + '/admin/production/get_users.php';
	
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
                width: "10px",
                className: "dt-body-right"
            },{
                targets: 6,
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
            { data: "UserId" },
            { data: "Username" },
            { data: "Password" },
            { data: "Name" },
            { data: "Email" },
            { data: "Type" },
            //{ data: "CreatedDate" },
            { 
                data: "UserId",
                render: function(data, type, row){
                    return '<a href="frm_users.php?userid='+data+'" target="_blank" title="Detail Data">View</a>';
                }
            }
        ]
    });

    $('#tblData tbody').on('click', 'button', function () {
        var data = table.row($(this).parents('tr')).data();
        var params = "tahun="+data["TAHUN"]+"&nomor-tapak="+data["NO_RENCANA"];

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
    	        var result = JSON.parse(this.responseText);
                if (result.data == null)
                    alert(result.message);
                else
                    //document.getElementById("demo").innerHTML = result.data["tapak_file"];
                    //alert(result.data["tapak_file"]);
                    window.open(result.data["tapak_file"],"_blank");
            }
        };
        xhttp.open("GET", "https://digitaru.bekasikota.go.id/api/public/tapak?"+params, true);
        xhttp.setRequestHeader("Api-Key", "d1g1t4rulaknduwdnj2eidudaklsnk4banwjkdnwjkb3k451jfbnaehbdf23eo8fnejsfbnkn");
        xhttp.send();
    });
});