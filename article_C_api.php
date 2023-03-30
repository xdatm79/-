<?php

require_once "dbtools.php";

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

if (isset($jsondata["chapter_Bl_id"]) && isset($jsondata["chapter_Title"]) && isset($jsondata["chapter_Content"])) {

    if ($jsondata["chapter_Bl_id"] != "" && $jsondata["chapter_Title"] != "" && $jsondata["chapter_Content"] != "") {

        $conn = create_connect();

        $Bl_id = $jsondata["chapter_Bl_id"];

        $Title = $jsondata["chapter_Title"];
        $Content = $jsondata["chapter_Content"];

        // unsigned表示正整數狀態
        $sql01 = " SELECT chapter_Chapter  FROM chapter WHERE chapter_Bl_id  = '$Bl_id' ORDER BY CAST(`chapter_Chapter` AS UNSIGNED) DESC LIMIT 0 , 1";

        $result01 = execute_sql($conn, "id20524484_fiction", $sql01);
        $Chapter = mysqli_fetch_assoc($result01);

        if (mysqli_num_rows($result01) > 0) {
            $Chapter = implode($Chapter) + 1;
            // echo $Chapter;
        } else {
            $Chapter = 1;
        }

        $sql = "INSERT INTO chapter( chapter_Bl_id,chapter_Chapter, chapter_Title, chapter_Content) VALUES (  '$Bl_id' , '$Chapter','$Title','$Content')";

        $result = execute_sql($conn, "id20524484_fiction", $sql);

        if ($result) {
            echo '{"state": true, "message":"新增章節成功!"}';
        } else {
            echo '{"state": false, "message":"新增章節失敗!"' . $sql . mysqli_error($conn) . '}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state": false, "message":"欄位不得為空白!"}';
    }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
