<?php
//INPUT: none
//Output:
// {"state": true, "message":"會員讀取成功!", "data" : 會員資料}
// {"state": false, "message":"會員讀取失敗!錯誤代碼或相關訊息"}

    require_once("dbtools.php");
    $link = create_connect();
    //AS -> 後面接要顯示的欄位, num ->自定義名稱, UserState -> 資料庫欄位 , GROUP BY -> 依 XX 欄位做分組
    $sql = "SELECT COUNT(UserState) AS num, UserState FROM member GROUP BY UserState";
    $result = execute_sql($link, "id19936188_fiction", $sql);
    if(mysqli_num_rows($result) > 0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        
        echo '{"state": true, "message":"會員狀態統計成功!", "data" : '.json_encode($mydata).'}';

        mysqli_close($link);
    }else{
        echo '{"state": false, "message":"會員讀取失敗!'.mysqli_error($link).'"}';
    }
?>