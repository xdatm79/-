<?php

// 所有會員
//INPUT: none
//Output:
// {"state": true, "message":"會員讀取成功!", "data" : 會員資料}
// {"state": false, "message":"會員讀取失敗!錯誤代碼或相關訊息"}

require_once "dbtools.php";
$link = create_connect();



$sql = "SELECT ID, Username, Email, userState, Created_at FROM member ORDER BY ID DESC";
$result = execute_sql($link, "id20524484_fiction", $sql);
if (mysqli_num_rows($result) > 0) {
    $mydata = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $mydata[] = $row;
    }

    echo '{"state": true, "message":"會員讀取成功!", "data" : ' . json_encode($mydata) . '}';

    mysqli_close($link);
} else {
    echo '{"state": false, "message":"會員讀取失敗!' . mysqli_error($link) . '"}';
}
