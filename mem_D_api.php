<?php
//INPUT: {"id":"XXX"}
//Output:
// {"state": true, "message":"刪除會員成功!"}
// {"state": false, "message":"刪除會員失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["id"])){
        if($mydata["id"] != ""){
            $p_id = $mydata["id"];

            require_once("dbtools.php");
            $link = create_connect();
            $sql = "DELETE FROM member WHERE ID = '$p_id'";
            $result = execute_sql($link, "id20524484_fiction", $sql);
            if($result && mysqli_affected_rows($link) == 1){
                echo '{"state": true, "message":"刪除會員成功!"}';
            }else{
                echo '{"state": false, "message":"刪除會員失敗!"}'.mysqli_error($link).'"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
?>