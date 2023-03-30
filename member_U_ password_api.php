<?php
//INPUT: {"ID":"9","password":"自", "new_possword":"自",  "verification":"自"}
//Output:
// {"state": true, "message":"更新會員成功!"}
// {"state": false, "message":"更新會員失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["ID"]) && isset($mydata["password"]) && isset($mydata["new_possword"])) {
    if ($mydata["ID"] != "" && $mydata["password"] != "" && $mydata["new_possword"] != "") {
        $p_id = $mydata["ID"];
        $password = $mydata["password"];
        $new_possword = $mydata["new_possword"];

        require_once "dbtools.php";
        $link = create_connect();

        //找出相同帳號的資料欄位
        $sql01 = "SELECT Username ,Password,UserState FROM member WHERE ID = '$p_id'";
        $result01 = execute_sql($link, "id20524484_fiction", $sql01);
        if (mysqli_num_rows($result01) == 1) {
            $row = mysqli_fetch_assoc($result01);
            $pwd_hash = $row["Password"]; //這Password是資料庫欄位名稱
            if (password_verify($password, $pwd_hash)) {
                //密碼驗證成功
                // password_hash雜湊函數加密處理
                $password = password_hash($new_possword, PASSWORD_DEFAULT);
                $sql = "UPDATE member SET Password = '$password' WHERE ID = '$p_id'";
                //產生UID並更新於資料庫
                $uid01 = substr(md5(hash("sha256",date("YmdHis"))),0,6);
                $uid02 = substr(md5(hash("sha256",uniqid())),0,6);
                $sql03 = "UPDATE member SET UID01 = '$uid01' ,UID02 = '$uid02' WHERE ID = '$p_id'";
                execute_sql($link, "id20524484_fiction", $sql);
                if (execute_sql($link, "id20524484_fiction", $sql03)) {
                    echo '{"state": true, "message":"密碼更新成功!"}';
                } else {
                    echo '{"state": false, "message":"密碼更新失敗!"' . mysqli_error($link) . '}';
                }
                mysqli_close($link);
            } else {
                // 密碼驗證失敗
                echo '{"state": false, "message":"登入失敗!';
            }
        } else {
            // 該筆ID不存在
            echo '{"state": false, "message":"登入失敗!"' . mysqli_error($conn) . '}';
        }
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
