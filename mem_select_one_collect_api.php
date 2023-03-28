<?php
//INPUT: {"id":"XXX"} 會員ID
//Output:
// {"state": true, "message":"讀取成功!", "data" : 單筆會員資料}
// {"state": false, "message":"讀取失敗!錯誤代碼或相關訊息"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"缺少規定欄位!"}


$data = file_get_contents("php://input", "r");
$mydata = array();
$mydata = json_decode($data, true);

if (isset($mydata["id"])) {
    if ($mydata["id"] != "") {
        $p_id = $mydata["id"];

        require_once "dbtools.php";
        $link = create_connect();

        $sql = "SELECT member.UserState ,collect.Collect_id , collect.Mem_id ,collect.Bl_id ,bl.Title, chapter_Chapter , chapter_Title, chapter_Update_at, img.File_img FROM (member LEFT JOIN collect ON member.ID = collect.Mem_id ) LEFT JOIN img ON collect.Bl_id =img.Bl_id LEFT JOIN (select * from ( SELECT * FROM chapter having 1 order by chapter_Update_at desc) AS b GROUP BY chapter_Bl_id) AS aa ON collect.Bl_id = chapter_Bl_id LEFT JOIN bl ON collect.Bl_id = bl.ID WHERE member.ID = '2' order by chapter_Update_at DESC;";
        // select * from  ( SELECT * FROM chapter having 1 order by chapter_Chapter desc) AS b GROUP BY chapter_Bl_id) AS aa
        // select * from ( SELECT * FROM chapter having 1 order by chapter_Update_at desc) AS b
        $result = execute_sql($link, "id19936188_fiction", $sql);

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
