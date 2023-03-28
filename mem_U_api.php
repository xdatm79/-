<?php
//INPUT: {"id":"XXX", "email":"XXXX"}
//Output:
// {"state": true, "message":"更新會員成功!"}
// {"state": false, "message":"更新會員失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["id"]) && isset($mydata["email"])){
        if($mydata["id"] != "" && $mydata["email"] != ""){
            $p_id = $mydata["id"];
            $p_email = $mydata["email"];

            require_once("dbtools.php");
            $link = create_connect();
            $sql = "UPDATE member SET Email = '$p_email' WHERE ID = '$p_id'";
            if(execute_sql($link, "id19936188_fiction", $sql)){
                echo '{"state": true, "message":"更新會員成功!"}';
            }else{
                echo '{"state": false, "message":"更新會員失敗!"'.mysqli_error($link).'}';
            }
            mysqli_close($link);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
?>