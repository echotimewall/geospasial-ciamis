<?php
$serverName = "localhost"; //serverName\instanceName
$connectionInfo = array( "Database"=>"db_simtaru", "UID"=>"sa", "PWD"=>"12345");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( !$conn ) {
     //echo "Connection could not be established.<br />";
//}else{
//     echo "Connection established.<br />";
	echo "<script>console.log('Connection could not be established.' );</script>";
     die( print_r( sqlsrv_errors(), true));
}
?>