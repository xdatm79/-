<?php

require_once "dbtools.php";

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

if (isset($jsondata["ID"]) &&isset($jsondata["title"]) && isset($jsondata["author"]) && isset($jsondata["summary"]) && isset($jsondata["statebl"])) {

    // if ($jsondata["ID"] != "" &&$jsondata["title"] != "" && $jsondata["author"] != "" && $jsondata["summary"] != "" && $jsondata["tags_id"] != "" && $jsondata["statebl"] != "") {

        $conn = create_connect();

        $ID=$jsondata["ID"];
        $title = $jsondata["title"];
        $author = $jsondata["author"];
        $summary = $jsondata["summary"];
        // $tags_id = $jsondata["tags_id"];
        $statebl = $jsondata["statebl"];
        

        $sql = "UPDATE bl SET Title = '$title', Author= '$author', Summary= '$summary', Statebl= '$statebl', Update_at = CURRENT_TIMESTAMP WHERE ID ='$ID' ";

        $result = execute_sql($conn, "id20524484_fiction", $sql);

        if ($result) {
            echo '{"state": true, "message":"小說資料修改成功!"}';
        } else {
            echo '{"state": false, "message":"小說資料修改失敗!"}';
        }

        mysqli_close($conn);

    // } else {
    //     echo '{"state": false, "message":"欄位不得為空白!"}';
    // }
} else {
    echo '{"state": false, "message":"缺少規定欄位!"}';
}
