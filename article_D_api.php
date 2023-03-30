<?php

require_once "dbtools.php";

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

if (isset($jsondata["chapter_ID"]) && isset($jsondata["chapter_Bl_id"])) {

    if ($jsondata["chapter_ID"] != "" && $jsondata["chapter_Bl_id"] != "") {

        $conn = create_connect();

        $ID = $jsondata["chapter_ID"];
        $Bl_id = $jsondata["chapter_Bl_id"];

        // $sql01 = " SELECT chapter_ID  FROM chapter WHERE chapter_Bl_id  = '$Bl_id' ORDER BY chapter_Chapter DESC LIMIT 0 , 1";
        $sql01 = "SELECT MAX(chapter_ID) chapter_ID FROM chapter WHERE chapter_Bl_id = '$Bl_id'";

        $result01 = execute_sql($conn, "id20524484_fiction", $sql01);

        // if (mysqli_num_rows($result01) > 0) {

        $row = mysqli_fetch_assoc($result01);

            // echo json_encode($row);
            // echo '{"chapter_ID":'.json_encode($ID).'}';
        // } else {

        // }

        // if ($result01 && mysqli_affected_rows($conn) == 1) {

        // } else {

        // }
//
        if (json_encode($row) == '{"chapter_ID":' . json_encode($ID) . '}') {

            $sql = "DELETE FROM chapter WHERE chapter_ID = '$ID' ";

            $result = execute_sql($conn, "id20524484_fiction", $sql);

            if ($result && mysqli_affected_rows($conn) == 1) {
                echo '{"state": true, "message":"章節刪除成功!"}';
            } else {
                echo '{"state": false, "message":"章節刪除失敗!"' . $sql . mysqli_error($conn) . '}';
            }
            mysqli_close($conn);
        } else {
            echo '{"state": false, "message":"刪除失敗，禁止從中間刪除章節!請從最後一個章節刪起!"}';
        }

    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
