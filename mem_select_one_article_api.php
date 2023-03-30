<?php
//INPUT: {"chap_id":"XXX"}
//Output:
// {"state": true, "message":"讀取成功!", "data" : 單筆會員資料}
// {"state": false, "message":"讀取失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}

$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["chap_id"])) {
    if ($mydata["chap_id"] != "") {
$id = $mydata["chap_id"];

require_once "dbtools.php";
$link = create_connect();

// $sql = "SELECT ID, Username, Email, Created_at FROM member WHERE ID = '$p_id'";

// $sql = "SELECT *  FROM (member LEFT JOIN bl ON member.ID = bl.Mem_id ) LEFT JOIN img ON bl.ID=img.Bl_id LEFT JOIN (SELECT MAX(chapter_Chapter) AS chapter_ID ,chapter_Chapter ,chapter_Bl_id ,chapter_Title,chapter_Update_at ,chapter_Created_at FROM chapter GROUP BY chapter_Bl_id ) AS aa ON bl.ID = chapter_Bl_id WHERE bl.ID = '$id' ";

$sql = "SELECT bl.*, chapter.* ,  img.File_img  FROM (member LEFT JOIN bl ON member.ID = bl.Mem_id ) LEFT JOIN img ON bl.ID=img.Bl_id LEFT JOIN chapter ON bl.ID = chapter.chapter_Bl_id WHERE bl.ID = '$id' ";

$result = execute_sql($link, "id20524484_fiction", $sql);

if (mysqli_num_rows($result) > 0) {
    //正確找到ID所對應的資料
    $mydata = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $mydata[] = $row;
    }
    echo '{"state": true, "message":"讀取資料成功!", "data":' . json_encode($mydata) . '}';

} else {
    //查無ID所對應的資料
    echo '{"state": false, "message":"讀取失敗!' . mysqli_error($link) . '"}';
}
mysqli_close($link);
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
