<?php
// 說明: 會員註冊
// input:
//     {"username":"自", "password":"自",  "email":"自@自"}

// output:
// {"state": true, "message":"註冊資料成功!"}
// {"state": false, "message":"註冊資料失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

require_once("dbtools.php");

$data = file_get_contents("php://input","r");
$jsondata = array();
$jsondata = json_decode($data,true);

if(isset($jsondata["username"]) && isset($jsondata["password"]) && isset($jsondata["email"])){
    if($jsondata["username"] != "" && $jsondata["password"] != "" && $jsondata["email"] != ""){
        

        $conn = create_connect();

        $username=$jsondata["username"];
        $password=$jsondata["password"];

        // password_hash雜湊函數加密處理
        $password=password_hash($password, PASSWORD_DEFAULT);
        $email=$jsondata["email"];

        $sql = "INSERT INTO member(Username,Password,Email) VALUES ('$username','$password','$email')";

        $result = execute_sql($conn, "id20524484_fiction", $sql);
        
        
        if($result){
            echo '{"state": true, "message":"新增資料成功!"}';
        }else{
            echo '{"state": false, "message":"新增資料失敗!.'.$sql.mysqli_error($conn).'"}';
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