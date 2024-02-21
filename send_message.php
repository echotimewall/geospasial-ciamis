<?php
	ini_set("display_errors", 1);
	ini_set('error_reporting', E_ALL);
	include 'config.php';
	session_start();
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nik = isset($_POST['nik']) ? $_POST['nik'] : '';
    $telp = isset($_POST['notelp']) ? $_POST['notelp'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $lokasi = isset($_POST['alamat']) ? $_POST['alamat'] : '';
	$pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';
    //$namaFile = isset($_POST['foto']) ? $_POST['foto'] : '';
    $x = isset($_POST['long']) ? $_POST['long'] : '';
    $y = isset($_POST['lat']) ? $_POST['lat'] : '';

    $dirUpload = "/pengaduan/";
    //require $dirUpload;
    //$namaFile = '';
    $status = 1;
    
    if ( !empty( $_FILES["file"]["name"] ) ) {
        $namaFile = basename($_FILES['file']['name']);
        $namaSementara = $_FILES['file']['tmp_name'];
        $terupload = move_uploaded_file($namaSementara, __DIR__.$dirUpload.$namaFile);    
    }
    else {
        $status = 0;
        $message = "File yang diupload tidak boleh kosong...";
    }
    
    /*$tsql_callSP = "exec DB_Proses @function= 1, @nama='".$nama."', @nik='".$nik."', @notelp='".$notelp."', @email='".$email."', @lokasi='".$alamat."', @laporan='".$pesan."', @foto='".$namaFile."', @x='".$x."', @y='".$y."'";*/
    $sql = 'INSERT INTO t_pengaduan (nama, nik, telp, email, lokasi, pesan, x, y, foto) VALUES (?,?,?,?,?,?,?,?,?)';

    if ($status == 1)
    {
        //$stmt3 = sqlsrv_query( $conn, $tsql_callSP);
        $row = $config->prepare($sql);
        $row -> execute(array($nama, $nik, $telp, $email, $lokasi, $pesan, $x, $y, $namaFile));

        if( !$row )
        {
            $message = "Pengiriman pengaduan gagal.";
        }
        else
        {
            $message = "Pengaduan berhasil dikirim.";
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