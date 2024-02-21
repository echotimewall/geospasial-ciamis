<?php
	ini_set("display_errors", 1);
	ini_set('error_reporting', E_ALL);
	include 'conn.php';
	session_start();
    $oid = isset($_POST['oid']) ? $_POST['oid'] : '';
    $st = isset($_POST['status']) ? $_POST['status'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

    $status = 1;
    if (!isset($_POST['oid']))
    {
        $status = 0;
        $message = "Pilih titik objek yang akan diupdate status dan keterangan !";
    }

    $message = "";

    $tsql_callSP = "exec DB_Proses @function=3, @objectID=".$oid.", @status='".$st."', @keterangan='".$keterangan."'";

    if ($status == 1)
    {
        $stmt3 = sqlsrv_query( $conn, $tsql_callSP);
        if( $stmt3 === false )
        {
            $message = "Status pengaduan gagal diupdate.";
        }
        else
        {
            $message = "Status pengaduan berhasil diupdate.";
        }
    }

    $products_arr=array();

    $products_arr=array();
    $product_item=array(
        "Message" => $message
    );
  
    array_push($products_arr, $product_item);	
	
    http_response_code(200);
  
    echo json_encode($products_arr);
    
?>