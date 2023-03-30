<?php
//INPUT: {"ID":"9","possword":"自",  "email":"自@自"}
//Output:
// {"state": true, "message":"更新會員成功!"}
// {"state": false, "message":"更新會員失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["ID"]) && isset($mydata["password"]) && isset($mydata["email"])) {
    if ($mydata["ID"] != "" && $mydata["password"] != "" && $mydata["email"] != "") {
        $p_id = $mydata["ID"];
        $p_email = $mydata["email"];
        $password = $mydata["password"];

        require_once "dbtools.php";
        $link = create_connect();

        //找出相同帳號的資料欄位
        $sql01 = "SELECT Username ,Password,UserState FROM member WHERE ID = '$p_id'";
        $result01 = execute_sql($link, "id20524484_fiction", $sql01);

        if (mysqli_num_rows($result01) == 1) {
            $row = mysqli_fetch_assoc($result01);
            $pwd_hash = $row["Password"];
            if (password_verify($password, $pwd_hash)) {
                //密碼驗證成功
                $sql = "UPDATE member SET Email = '$p_email' WHERE ID = '$p_id'";
                if (execute_sql($link, "id20524484_fiction", $sql)) {
                    echo '{"state": true, "message":"信箱更新成功!"}';
                } else {
                    echo '{"state": false, "message":"信箱更新失敗!"' . mysqli_error($link) . '}';
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
