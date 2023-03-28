<?php
// 說明: 確認帳號是否存在
// input:
//     {"username":"自"}

// output:
// {"state": true, "message":"該帳號不存在，可以使用!"}
// {"state": false, "message":"帳號存在，請重新設定!"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}



$data = file_get_contents("php://input","r");
$jsondata = array();
$jsondata = json_decode($data,true);

if(isset($jsondata["username"]) ){
    if($jsondata["username"] != "" ){
        
        require_once("dbtools.php");
        $conn = create_connect();

        $username=$jsondata["username"];

        $sql = "SELECT Username FROM member WHERE Username = '$username'";

        $result = execute_sql($conn, "id19936188_fiction", $sql);
        
        
        if(mysqli_num_rows($result) == 1){
            //帳號已經存在
            echo '{"state": false, "message":"該帳號已存在, 帳號不可以使用!"}';
        }else{
            //帳號不存在
            echo '{"state": true, "message":"該帳號不存在, 帳號可以使用!"}';
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