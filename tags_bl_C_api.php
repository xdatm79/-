<?php

require_once "dbtools.php";

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

// if ( isset($jsondata["user_id"]) && isset($jsondata["tags_id"]) ) {

//     if ($jsondata["user_id"] != "" && $jsondata["tags_id"] != "" ) {
if (  isset($jsondata["tags_id"]) ) {

    if ( $jsondata["tags_id"] != "" ) {
        
        $conn = create_connect();

        // $user_id = $jsondata["user_id"];

        $tags_id = $jsondata["tags_id"];


        // $sql = "INSERT INTO tags_bl(User_id, Tags_id) VALUES ( '$user_id' ,'$tags_id')";
        $sql = "INSERT INTO tags_bl( Tags_id) VALUES (  '$tags_id')";

        $result = execute_sql($conn, "id19936188_fiction", $sql);

        if ($result) {
            echo '{"state": true, "message":"新增資料成功!"}';
        } else {
            echo '{"state": false, "message":"新增資料失敗!錯誤代碼或相關訊息"'.$sql.mysqli_error($conn).'}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
