<?php

include("config/db.php");
include("cmd/exec.php");

$db = new Database();
$strConn = $db->getConnection();
$strExe = new ExecSQL($strConn);
$action = $_GET['cmd'];

if ($action == "login") {
    $strUsername = $_GET['username'];
    $strPassword = $_GET['password'];

    $condition = " WHERE username = '$strUsername' AND password = '$strPassword' ";
    $stmt = $strExe->readOne("tb_user",$condition);
    $num_row = $strExe->rowCount1("tb_user",$condition);
    //echo json_encode("ok");
    //echo json_encode($num_row);
    //echo json_encode($num_row);

  if($num_row > 0){
    //echo json_encode("YES");
    //echo "login สำเร็จ";
    $data_arr['rs'] = array();
        foreach($stmt as $row ){
            $item = array(
                'firstname'=>$row['firstname'],
                'lastname'=> $row['lastname']
            );
            $status = array(
              'Status'=>"Login สำเร็จ"
            );

            array_push($data_arr['rs'], $status ,$item);
            echo json_encode($data_arr);
    }

  }
  else{
    echo json_encode("NO");
  //  echo "login ไม่สำเร็จ";
  }





}else if ($action == "login1"){
  $str_user_id = $_GET['user_id'];
  $stmt = $strExe->readOne("tb_user"," where user_id = ".$str_user_id);
  $data_arr['rs'] = array();
      foreach($stmt as $row ){
          $item = array(
              'firstname'=>$row['firstname'],
              'lastname'=> $row['lastname']

          );
          array_push($data_arr['rs'], $item);
          echo json_encode($data_arr);
  }


  if($stmt){
    echo json_encode("Yes");
  }
  else{
      echo json_encode("No");
  }

}

?>
