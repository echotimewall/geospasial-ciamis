<?php
    @ob_start();
    require 'connections.php';

    $id = $_GET['id'];

    $table = "Dankir_Irigasi_Detail";
    if ($id == 'D.I Nanggela')
        $table = "Nanggela_Irigasi_Detail";

    $sql = 'select * from "'.$table.'"';
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