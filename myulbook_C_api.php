<?php

require_once "dbtools.php";

$data = file_get_contents("php://input", "r");
$jsondata = array();
$jsondata = json_decode($data, true);

// if (isset($jsondata["title"]) && isset($jsondata["user_id"]) &&  isset($jsondata["author"]) && isset($jsondata["summary"]) && isset($jsondata["tags_id"]) && isset($jsondata["statebl"])) {

if (isset($jsondata["id"]) && isset($jsondata["title"]) &&  isset($jsondata["author"]) && isset($jsondata["summary"]) && isset($jsondata["tags_id"]) &&  isset($jsondata["statebl"])) {

    if ($jsondata["id"] != ""  && $jsondata["title"] != ""  && $jsondata["author"] != "" && $jsondata["summary"] != "" && $jsondata["tags_id"] != "" &&  $jsondata["statebl"] != "") {

        $conn = create_connect();

        $user_id = $jsondata["id"];
        $title = $jsondata["title"];
        $author = $jsondata["author"];
        $summary = $jsondata["summary"];
        $tags_id = $jsondata["tags_id"];
        $statebl = $jsondata["statebl"];
        $bl_id ;



        // $sql = "INSERT INTO bl(User_id, Title, Author, Summary, Tags_id,Statebl) VALUES ( '$user_id' ,' $title','$author','$summary','$tags_id',' $statebl')";

        $sql = "INSERT INTO bl( Mem_id,Title, Author, Summary,  Statebl) VALUES (  '$user_id' , '$title','$author','$summary','$statebl')";
        $result = execute_sql($conn, "id19936188_fiction", $sql);

        $sql01 = "SELECT ID FROM bl ORDER BY ID DESC LIMIT 0 , 1";
        $result01 = execute_sql($conn, "id19936188_fiction", $sql01);

        if (mysqli_num_rows($result01) == 1) {
            $row = mysqli_fetch_assoc($result01);
            $bl_id = $row["ID"];
        }

        if (isset(explode(",", $tags_id)[1])) {
            // echo ("2");}else{echo ("1");}
            $tags_id = explode(",", $tags_id); //字串根據,切
            // echo $p_id[0]." ";
            // $data = array();
            for ($i = 0; $i < count($tags_id); $i++) {
                // echo $tags_id[$i] . " ";
                $tags_id01 = strval($tags_id[$i]) . "";
                // echo $tags_id01;
                //  echo count($tags_id);
                $sql02 = "INSERT INTO tags_bl( tags_bl_Bl_id,	tags_bl_Tags) VALUES ( '$bl_id','$tags_id01')";

                $result02 = execute_sql($conn, "id19936188_fiction", $sql02);
                // if ($result02 && mysqli_affected_rows($conn) == 1) {
                //     $data[] = array_push($data);
                // }
                // print_r($data);  //印陣列
            }


            if ($result && $result01 && $result02 ) {
                echo '{"state": true, "message":"bl新增資料成功!"}';
            } else {
                echo '{"state": false, "message":"新增資料失敗!"' . $sql . mysqli_error($conn) . '}';
            }
            mysqli_close($conn);
        } else {
            echo '{"state": false, "message":"欄位不得為空白!"}';
        }
    } else {
        echo '{"state": false, "message":"缺少規定欄位!"}';
    }
}
