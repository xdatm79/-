<?php

require_once "dbtools.php";

$conn = create_connect();

$sql = "SELECT ID FROM bl ORDER BY Update_at DESC LIMIT 0 , 1";
$result = execute_sql($conn, "id19936188_fiction", $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $bl_id = $row["ID"];
}
$bl_id;

// 設公有變數
$location;

if ($_FILES['myfile01']["name"] != "") {
    if ($_FILES["myfile01"]["error"] > 0) {
        echo "Error: " . $_FILES["myfile01"]["error"] . "";
    } else {
        // echo "檔名: " . $_FILES["file"]["name"] . "";
        // echo "類型: " . $_FILES["file"]["type"] . "";
        // echo "大小: " . (ROUND($_FILES["file"]["size"] / 1024/1024,2)) . " MB";
        // echo "暫存名稱 : " . $_FILES["file"]["tmp_name"];

        $file = explode(".", $_FILES["myfile01"]["name"]);
        //echo $file[0];/*主檔名*/
        //echo $file[1];/*副檔名*/

        //設定新檔名
        $new_name = $bl_id . '.' . $file[1];

        // 設定存放路徑變數
        $location = "img/" . $new_name; //檔案儲存的資料夾路徑

        //移動檔案到指定目錄
        move_uploaded_file($_FILES["myfile01"]["tmp_name"], $location);
        
        $sql_01 = "UPDATE img SET File_img ='$location' , Update_at = CURRENT_TIMESTAMP WHERE Bl_id ='$bl_id'";

        $result01 = execute_sql($conn, "id19936188_fiction", $sql_01);

        if ($result01) {
            echo '{"state": true, "message":"img更新成功!"}';
        } else {
            echo '{"state": false, "message":"img更新失敗"' . $sql . mysqli_error($conn) . '}';
        }

        mysqli_close($conn);

    }
} else {

    // // 設定存放路徑變數
    // $location = "img/預設.jpg"; //檔案儲存的資料夾路徑
    echo '{"state": false, "message":"img未更新"' . $sql . mysqli_error($conn) . '}';

}
