<?php
// 說明: 會員登入
// input:
//     {"username":"自", "possword":"自"}

// output:
// {"state": true, "message":"登入成功!"}
// {"state": false, "message":"登入失敗!"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

if (isset($jsondata["username"]) && isset($jsondata["password"])) {
    if ($jsondata["username"] != "" && $jsondata["password"] != "") {

        require_once "dbtools.php";
        $conn = create_connect();

        $username = $jsondata["username"];
        $password = $jsondata["password"];

        // 註冊時，使用password_hash雜湊函數加密處理

        //找出相同帳號的資料欄位
        $sql = "SELECT Username ,Password,UserState FROM member WHERE Username = '$username'";

        $result = execute_sql($conn, "id19936188_fiction", $sql);

        if (mysqli_num_rows($result) == 1) {
            // 該筆帳號存在
            $row = mysqli_fetch_assoc($result);
            $pwd_hash = $row["Password"];

            if (password_verify($password, $pwd_hash)) {
                //密碼驗證成功
                //產生UID並更新於資料庫
                $uid01 = substr(md5(hash("sha256",date("YmdHis"))),0,6);
                $uid02 = substr(md5(hash("sha256",uniqid())),0,6);
                $sql = "UPDATE member SET UID01 = '$uid01' ,UID02 = '$uid02' WHERE Username = '$username'";
                execute_sql($conn, "id19936188_fiction", $sql);

                //撈取密碼以外的欄位  (權限 是否停權)
                $sql = "SELECT ID, Username , UserState, UID01, UID02 FROM member WHERE Username = '$username'";
                $result = execute_sql($conn, "id19936188_fiction", $sql);
                $row = mysqli_fetch_assoc($result);
                $userData = array();
                $userData[] = $row;

                echo '{"state": true, "message":"登入成功!","data": ' . json_encode($userData) . '}';
            } else {
                // 密碼驗證失敗
                echo '{"state": false, "message":"登入失敗!';
            }
        } else {
            // 該筆帳號不存在
            echo '{"state": false, "message":"登入失敗!"' . mysqli_error($conn) . '}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}

// require_once("dbtools.php");

// $conn = create_connect();

// if($conn){
//     echo'ok';
// }
