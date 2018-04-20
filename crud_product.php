<?php
include("config/db.php");
include("cmd/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_GET['cmd'];
switch($action){
    case 'select' :
    $stmt = $str_exe->readAll("product");
    $data_arr['rs'] = array();
    
    foreach($stmt as $row ){
        $item = array(
            'Code'=>$row['product_code'],
            'name'=> $row['name'],
            'detail'=> $row['detail'],
            'img'=> $row['img']
        );
        array_push($data_arr['rs'],$item);
        echo json_encode($data_arr);
        }
    break;   
}
?>