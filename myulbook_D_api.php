<?php

require_once "dbtools.php";

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

if (isset($jsondata["ID"])) {

    if ($jsondata["ID"] != "") {
        
        $conn = create_connect();

        $ID=$jsondata["ID"];

        $sql = "DELETE FROM bl WHERE ID = '$ID' ";

        $result = execute_sql($conn, "id20524484_fiction", $sql);

        if ($result && mysqli_affected_rows($conn) == 1) {
            echo '{"state": true, "message":"刪除資料成功!"}';
        } else {
            echo '{"state": false, "message":"刪除資料失敗!"'.$sql.mysqli_error($conn).'}';
        }
        mysqli_close($conn);

    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
