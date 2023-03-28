<?php

require_once "dbtools.php";

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

if (isset($jsondata["chapter_ID"]) && isset($jsondata["chapter_Title"]) && isset($jsondata["chapter_Content"])) {

    // if ($jsondata["chapter_Bl_id"] != ""  && $jsondata["chapter_Chapter"] != ""  && $jsondata["chapter_Title"] != "" && $jsondata["chapter_Content"] != "" ) {

    $conn = create_connect();

    $ID = $jsondata["chapter_ID"];
    $Title = $jsondata["chapter_Title"];
    $Content = $jsondata["chapter_Content"];

    $sql = "UPDATE chapter SET  chapter_Title= '$Title', chapter_Content= '$Content', chapter_Update_at = CURRENT_TIMESTAMP WHERE chapter_ID ='$ID' ";

    $result = execute_sql($conn, "id19936188_fiction", $sql);

    if ($result) {
        echo '{"state": true, "message":"章節修改成功!"}';
    } else {
        echo '{"state": false, "message":"章節修改失敗!"' . $sql . mysqli_error($conn) . '}';
    }
    mysqli_close($conn);
    // } else {
    //     echo '{"state": false, "message":"欄位不得為空白!"}';
    // }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
