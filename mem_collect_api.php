<?php
//INPUT: {"Mem_id":"XXX",{"Bl_id":"XXX"}
//Output:
// {"state": true, "message":"讀取成功!", "data" : 單筆會員資料}
// {"state": false, "message":"讀取失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["Mem_id"]) && isset($mydata["Bl_id"])) {
    if ($mydata["Mem_id"] != "" && $mydata["Bl_id"] != "") {
        $Mem_id = $mydata["Mem_id"];
        $Bl_id = $mydata["Bl_id"];

        require_once("dbtools.php");
        $link = create_connect();

        $sql = "SELECT Collect_id FROM collect WHERE Mem_id = '$Mem_id' AND Bl_id ='$Bl_id' ";
        $result = execute_sql($link, "id20524484_fiction", $sql);

        if (mysqli_num_rows($result) == 1) {
            //找到所對應的資料
            // $mydata01 = array();
            // while ($row = mysqli_fetch_assoc($result)) {
            //     $mydata01[] = $row;
            // }
            $row = mysqli_fetch_assoc($result);
            $Collect_id = $row["Collect_id"];
            $sql01 = "DELETE FROM collect WHERE Collect_id = '$Collect_id'";
            $result01 = execute_sql($link, "id20524484_fiction", $sql01);
            if ($result01 && mysqli_affected_rows($link) == 1) {
                echo '{"state": true, "message":"取消收藏成功!"}';
            } else {
                echo '{"state": false, "message":"取消收藏失敗!' . mysqli_error($link) . '"}';
            }
        } else if (mysqli_num_rows($result) == 0) {
            //查無所對應的資料
            $sql02 = "INSERT INTO collect ( Mem_id , Bl_id) VALUES ('$Mem_id','$Bl_id') ";
            $result02 = execute_sql($link, "id20524484_fiction", $sql02);
            if ($result02) {
                echo '{"state": true, "message":"收藏成功!"}';
            } else {
                echo '{"state": false, "message":"收藏失敗!' . mysqli_error($link) . '"}';
            }
        }
        mysqli_close($link);
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
