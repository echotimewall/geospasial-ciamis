<?php
    @ob_start();
    require '../../config.php';

    $sql = 'select UserId, Username, Password, Name, Email, Type, CreatedDate from t_users';
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