<?php
// 說明: 確認帳號是否存在
// input:
//     {"uid01":"XXX","uid02":"XXX"}

// output:
// {"state": true, "message":"登入狀態確認成功!", "data" : 該筆會員資料}
// {"state": false, "message":"登入狀態確認失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}



$data = file_get_contents("php://input","r");
$jsondata = array();
$jsondata = json_decode($data,true);

if(isset($jsondata["uid01"]) && isset($jsondata["uid02"]) ){
    if($jsondata["uid01"] != "" && $jsondata["uid02"] != "" ){
        
        require_once("dbtools.php");
        $conn = create_connect();

        $uid01=$jsondata["uid01"];
        $uid02=$jsondata["uid02"];

        $sql = "SELECT ID, Username, Email, UserState, Created_at FROM member WHERE UID01 = '$uid01' AND UID02 = '$uid02'";

        $result = execute_sql($conn, "id20524484_fiction", $sql);
        
        
        if(mysqli_num_rows($result) == 1){
            //uid 合法
            $userData = array();
            $row = mysqli_fetch_assoc($result);
            $userData[] = $row;
            echo '{"state": true, "message":"登入狀態確認成功!", "data" : '.json_encode($userData).'}';
        }else{
            //不符合
            echo '{"state": false, "message":"登入狀態確認失敗!'.mysqli_error($conn).'"}';
        }
        mysqli_close($conn);

    }else{
        echo'{"state": false, "message":"欄位不得為空白!"}';
    }
}else{
    echo'{"state": false, "message":"缺少規定欄位!"}';
}

// require_once("dbtools.php");

// $conn = create_connect();

// if($conn){
//     echo'ok';
// }










?>