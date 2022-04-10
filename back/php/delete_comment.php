<?php
    require_once 'db.php';
    $del=del_article($_POST['id']);
    $error = 0;
    if($del){
        echo 'yes';
    }else{
        $error = 1;
    }
    if($error == 1){
        if(del_again($_POST['id'])){
            echo 'yes!!';
        }else{
            echo 'no';
        }
    }
    

    function del_article($id)
    {
    //宣告空的陣列
        $del=null;
        // $member = array();
        
        //將查詢語法當成字串，記錄在$sql變數中
        $sql = "DELETE FROM `comment`,`prefer` WHERE `comment`.`id` = {$id} AND `prefer`.`comment_id` = {$id} ;";
           
        // $sql = "SELECT COUNT(*) AS TOTAL ,`comment_id` FROM `prefer` WHERE `prefer` = 1 GROUP BY `comment_id` ORDER BY TOTAL DESC LIMIT 3;"; // ORDER BY `create_date` DESC 代表是排序，使用 `create_date` 這欄位， DESC 是從最大到最小(最新到最舊)
        //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
        $query = mysqli_query($_SESSION['link'], $sql);

        //如果請求成功
        if ($query)
        {
            //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
            if (mysqli_affected_rows($_SESSION['link']) > 0 )
            {
            
            //取得的量大於0代表有資料
            //while迴圈會根據查詢筆數，決定跑的次數
            //mysqli_fetch_assoc 方法取得 一筆值
                $del=true;
            }
        }
        else
        {
            echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
        }

        //回傳結果
        // return $member;
        return $del;
    }
    
    
    function del_again($id)
    {
    //宣告空的陣列
        $delete=null;
        // $member = array();
        
        //將查詢語法當成字串，記錄在$sql變數中
        $sql = "DELETE FROM `comment` WHERE `id` = {$id};"; 
           
        // $sql = "SELECT COUNT(*) AS TOTAL ,`comment_id` FROM `prefer` WHERE `prefer` = 1 GROUP BY `comment_id` ORDER BY TOTAL DESC LIMIT 3;"; // ORDER BY `create_date` DESC 代表是排序，使用 `create_date` 這欄位， DESC 是從最大到最小(最新到最舊)
        //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
        $query = mysqli_query($_SESSION['link'], $sql);

        //如果請求成功
        if ($query)
        {
            //使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
            if (mysqli_affected_rows($_SESSION['link']) > 0 )
            {
            
            //取得的量大於0代表有資料
            //while迴圈會根據查詢筆數，決定跑的次數
            //mysqli_fetch_assoc 方法取得 一筆值
                $delete=true;
            }
        }
        else
        {
            echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
        }

        //回傳結果
        // return $member;
        return $delete;
    }
?>