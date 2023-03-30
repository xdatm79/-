<?php
// 說明: 更新章節-換頁
//{"id":"2"}
//{"state": true, "message":"讀取資料成功!", "data":輸出的json資料}
// {"state": false, "message":"讀取資料失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

//利用input ID去執行撈取該筆資料

require_once "dbtools.php";
$data = file_get_contents("php://input", "r");
$dataJson = array();
$dataJson = json_decode($data, true);

if (isset($dataJson["id"])) {
    if ($dataJson["id"] != "") {

        $p_id = $dataJson["id"];


        $conn = create_connect();


        $sql = "SELECT * FROM chapter WHERE chapter_ID = '$p_id'";

        $result = execute_sql($conn, "id20524484_fiction", $sql);

        // $line= mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1) {
            $lineData = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $lineData[] = $row;
            }
            echo '{"state": true, "message":"讀取資料成功!", "data":' . json_encode($lineData) . '}';
        } else {
            echo '{"state": false, "message":"讀取資料失敗!錯誤代碼或相關訊息"}';
        }

        mysqli_close($conn);
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
