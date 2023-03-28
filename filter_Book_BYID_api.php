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



        require_once "dbtools.php";
        $link = create_connect();

        $sql = "SELECT * FROM bl LEFT JOIN (SELECT tags_bl_Bl_id , GROUP_CONCAT(tags_bl.tags_bl_Tags) as 'tags_bl_Tag' FROM tags_bl GROUP BY tags_bl_Bl_id) as dd on tags_bl_Bl_id =bl.ID LEFT JOIN img ON bl.ID=img.Bl_id LEFT JOIN (select * from ( SELECT * FROM chapter having 1 order by CAST(`chapter_Chapter` AS UNSIGNED) desc) AS b GROUP BY chapter_Bl_id) AS aa ON bl.ID = chapter_Bl_id ORDER BY bl.ID DESC";

        $result = execute_sql($link, "id19936188_fiction", $sql);

        if (mysqli_num_rows($result) > 0) {
            //正確找到所對應的資料
            $mydata = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $mydata[] = $row;
            }
            echo '{"state": true, "message":"讀取篩選後資料成功--依ID!", "data":' . json_encode($mydata) . '}';
        } else {
            //查無所對應的資料
            echo '{"state": false, "message":"讀取tag失敗!' . mysqli_error($link) . '"}';
        }
        mysqli_close($link);
