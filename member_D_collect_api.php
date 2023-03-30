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


if (isset($mydata["id"])) {
    if ($mydata["id"] != "") {
        $p_id = $mydata["id"];
        require_once "dbtools.php";
        $link = create_connect();
        // $p_id01=mb_strlen($p_id);//字串長度
        // echo (mb_strlen($p_id));
        // echo (explode(",", $p_id)[1]);
        if (isset(explode(",", $p_id)[1])) {
            // echo ("2");}else{echo ("1");}
            $p_id = explode(",", $p_id); //字串根據,切
            // echo $p_id[0]." ";
            $data = array();
            for ($i = 0; $i < count($p_id); $i++) {
                // echo $p_id[$i] . " ";
                $p_id01 = strval($p_id[$i]) . "";
                // echo $p_id01;
                $sql = "DELETE FROM collect WHERE Collect_id = '$p_id01'";
                $result = execute_sql($link, "id20524484_fiction", $sql);
                if ($result && mysqli_affected_rows($link) == 1) {
                $data[] = array_push($data);                
                }
                // print_r($data);  //印陣列
            }
            // echo count($data)." ";
            // echo $i." ";
            if (count($data) == $i) {
                echo '{"state": true, "message":"收藏刪除成功!"}';
            } else {
                echo '{"state": false, "message":"收藏刪除失敗!"' . mysqli_error($link) . '}';
            }
            mysqli_close($link);
        } else {
            $sql = "DELETE FROM collect WHERE Collect_id = '$p_id'";
            $result = execute_sql($link, "id20524484_fiction", $sql);
            if ($result && mysqli_affected_rows($link) == 1) {
                echo '{"state": true, "message":"收藏刪除成功!"}';
            } else {
                echo '{"state": false, "message":"收藏刪除失敗!"' . mysqli_error($link) . '}';
            }

            mysqli_close($link);
        }
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
