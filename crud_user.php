<?php
include("config/db.php");
include("cmd/exec.php");
$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action= $_GET['cmd'];
switch($action){
    case 'select' :
    $stmt = $str_exe->readAll("tb_user");
    $num_row = $str_exe->rowCount("tb_user");
   //echo json_encode($num_row);
    if ($num_row>0){
        $data_arr['rs'] = array();
        foreach($stmt as $row){
            $item = array(
                'firstname '=>$row['firstname'],
                'username' =>$row['username'],
                'password' =>$row['password'],
                'lastname ' =>$row['lastname']

            );
            //echo json_encode($num_row);
            array_push($data_arr['rs'],$item);
        }
            echo json_encode($data_arr);

    }else{
        echo json_encode(array('msg'=>'result not format'));
    }
    break;

    case 'read' :
    $str_user_id = $_GET['user_id'];
    $stmt = $str_exe->readOne("tb_user"," where user_id = ".$str_user_id);
    $data_arr['rs'] = array();
        foreach($stmt as $row ){
            $item = array(
                'firstname'=>$row['firstname'],
                'lastname'=> $row['lastname']

            );
            array_push($data_arr['rs'], $item);
            echo json_encode($data_arr);
    }

    break;

    case 'insert':
    $strUsername = $_GET['username'];
    $strPass = $_GET['password'];
    $strfname = $_GET['firstname'];
    $strlname = $_GET['lastname'];
    $strSQL = $str_exe->insert("tb_user"," username, password ,firstname ,lastname "," '".$strUsername."','".$strPass."','".$strfname."','".$strlname."' ");

    if($strSQL){
        echo json_encode(array('msg'=>'บันทึกข้อมูลเรีบยร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถบันทึกข้อมูลได้'));
    }
    break;

    case 'delete':
    $strid = $_GET['user_id'];
    //$strSQL = $str_exe->delete("tb_user"," WHERE user_id = ".$strid);
    $strSQL = $str_exe->delete("tb_user","user_id ",$strid);
    if($strSQL){
        echo json_encode(array('msg'=>'ลบสำเร็จ'));
    }else{
        echo json_encode(array('msg'=>'ลบไม่สำเร็จ'));
    }
    break;

    case 'update':
    $strUsername = $_GET['user'];
    $strPassword = $_GET['pass'];
    $strId       = $_GET['id'];
    $strSQL = $str_exe->update("tb_user "," SET username = '$strUsername' ,password = '$strPassword' WHERE user_id = $strId");
    if($strSQL){
        echo json_encode(array('msg'=>'สำเร็จ'));
    }else{
        echo json_encode(array('msg'=>'ไม่สำเร็จ'));
    }
    break;
}

?>
