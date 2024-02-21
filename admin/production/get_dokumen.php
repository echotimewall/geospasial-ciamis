<?php
    @ob_start();
    require '../../config.php';

    $sql = 'select * from t_jembatan';
    $row = $config->prepare($sql);
    $row -> execute();
    $jum = $row -> rowCount();
    $arr = array();
    if($jum > 0){
        
        //$hasil = $row -> fetch();
        while ($hasil = $row -> fetch())
        {
            /*$product_item=array(
                "id" => $hasil[0],
                "pemohon" => $hasil[1],
                "tahun" => $hasil[2],
                "peruntukan" => $hasil[3],
                "no_rencana" => $hasil[4],
                "pemanfaatan" => $hasil[5],
                "luas" => $hasil[6],
                "koordinat" => $hasil[7]
            );*/

            array_push($arr, $hasil);
            //echo $hasil;
        }
    }

    http_response_code(200);
    echo json_encode($arr);
    //echo $hasil;

?>