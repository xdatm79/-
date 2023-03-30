<?php
// 計算會員總數
//INPUT: none
//Output:
// {"state": true, "message":"會員總數計算成功!", "data" : 會員數}
// {"state": false, "message":"會員總數計算失敗!錯誤代碼或相關訊息"}

require_once("dbtools.php");
$link = create_connect();
$sql = "SELECT count(*) as total_member FROM member";
$result = execute_sql($link, "id20524484_fiction", $sql);
if(mysqli_num_rows($result) > 0){
    $mydata = array();
    while($row = mysqli_fetch_assoc($result)){
        $mydata[] = $row;
    }
    
    echo '{"state": true, "message":"會員總數統計成功!", "data" : '.json_encode($mydata).'}';

    mysqli_close($link);
}else{
    echo '{"state": false, "message":"會員讀取失敗!'.mysqli_error($link).'"}';
}
?>