<?php
   date_default_timezone_set("Asia/Jakarta");
   error_reporting(0);

	$host 	= '157.10.157.37'; // host server
	$user 	= 'postgres';  // username server
	$pass 	= 'postgis_bappeda3204'; // password server, kalau pakai xampp kosongin saja
	$dbname = 'postgis_db'; // nama database anda
	
	try{
		$config = new PDO("pgsql:host=$host;port=5432;dbname=$dbname;", $user,$pass);
	}catch(PDOException $e){
		echo 'KONEKSI GAGAL ' .$e -> getMessage();
	}
?>