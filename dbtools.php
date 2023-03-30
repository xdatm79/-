<?php
    function create_connect(){
        $link = mysqli_connect("localhost", "id20524484_id19936188_xdatm79", "Asdzxc?><123456")
            or die("連線失敗!".mysqli_connect_error());
        
        return $link;
    }

    function execute_sql($link, $dbname, $sql){
        // 下面是設定編碼
        mysqli_query($link,'set names utf8');
        mysqli_select_db($link, $dbname)
            or die("連線資料庫失敗!".mysqli_error($link));
        $result = mysqli_query($link,$sql);
        
        return $result;
    }

?>