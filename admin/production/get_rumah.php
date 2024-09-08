<?php
    @ob_start();
    require 'connections.php';

    $sql = 'select * from "Sebaran_Perumahan"';
    $row = $config->prepare($sql);
    $row -> execute();
    $jum = $row -> rowCount();
    $arr = array();
    if($jum > 0){
        
        while ($hasil = $row -> fetch())
        {          
            array_push($arr, $hasil);
        }
    }

    http_response_code(200);
    echo json_encode($arr);

?>