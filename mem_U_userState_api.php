<?php
// 會員狀態更新(啟用或停權)
//INPUT: {"id":12,"userState": "y"}
//       {"id":12,"userState": "n"}
//Output:
// {"state": true, "message":"更新會員狀態成功!"}
// {"state": false, "message":"更新會員狀態失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["id"]) && isset($mydata["userState"])){
        if($mydata["id"] != "" && $mydata["userState"] != ""){
            $id = $mydata["id"];
            $userState = $mydata["userState"];

            require_once("dbtools.php");
            $link = create_connect();
            $sql = "UPDATE member SET UserState = '$userState' WHERE ID = '$id'";
            if(execute_sql($link, "id19936188_fiction", $sql) && mysqli_affected_rows($link) == 1){
                echo '{"state": true, "message":"更新會員狀態成功!"}';
            }else{
                echo '{"state": false, "message":"更新會員狀態失敗!"'.mysqli_error($link).'}';
            }
            mysqli_close($link);
        }else{
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    }else{
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
?>