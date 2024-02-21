<?php
    @ob_start();
    require '../../config.php';

    $sql = 'select * from t_pengaduan';
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
    //echo $jum;

?>