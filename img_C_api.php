<?php
require_once "dbtools.php";

$conn = create_connect();

$sql = "SELECT ID FROM bl ORDER BY ID DESC LIMIT 0 , 1";
$result = execute_sql($conn, "id19936188_fiction", $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $bl_id = $row["ID"];
}

//設公有變數
$location;

if ($_FILES['myfile01']["name"] != "") {

    // $sql = "SELECT ID FROM bl ORDER BY ID DESC LIMIT 0 , 1";
    // $result = execute_sql($conn, "id19936188_fiction", $sql);

    if ($_FILES["myfile01"]["error"] > 0) {
        echo "Error: " . $_FILES["myfile01"]["error"] . "";
    } else {
        // echo "大小: " . (ROUND($_FILES["file"]["size"] / 1024/1024,2)) . " MB";
        $file = explode(".", $_FILES["myfile01"]["name"]);
        //echo $file[0];/*主檔名*/
        //echo $file[1];/*副檔名*/

        //設定新檔名
        $new_name = $bl_id . '.' . $file[1];

        // 設定存放路徑變數
        $location = "img/" . $new_name; //檔案儲存的資料夾路徑

        //移動檔案到指定目錄
        move_uploaded_file($_FILES["myfile01"]["tmp_name"], $location);

        //重新命名
        // rename("img/".$_FILES["myfile01"]["name"], "img/".$new_name);

    }
} else {

    // 設定存放路徑變數
    $location = "img/預設.jpg"; //檔案儲存的資料夾路徑

}

$sql_01 = "INSERT INTO img( Bl_id ,File_img) VALUES ( '$bl_id','$location')";
// // $sql_01= "INSERT INTO img( File_img) VALUES ( '$file_img')";

$result01 = execute_sql($conn, "id19936188_fiction", $sql_01);

if ($result01) {
    echo '{"state": true, "message":"img新增資料成功!"}';
} else {
    echo '{"state": false, "message":"新增資料失敗!錯誤代碼或相關訊息"' . $sql . mysqli_error($conn) . '}';
}

mysqli_close($conn);
