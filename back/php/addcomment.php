<?php
    require_once 'db.php';
    // require_once 'functions.php';


    $result=addcomment($_POST['title'],$_POST['content'],$_POST['user'],$_POST['userid']);
    if($result){
        echo 'yes';
    }else{
        echo 'no';
    }

    function addcomment($title, $content, $user, $userid)
    {
        //宣告要回傳的結果
        $result = null;
        //先把密碼用md5加密
        // $password = md5($password);
    //將查詢語法當成字串，記錄在$sql變數中
        $sql = "INSERT INTO `comment` (`title`, `comment`, `poster`) VALUE ('{$title}', '{$content}', '{$userid}');";

        //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
        $query = mysqli_query($_SESSION['link'], $sql);

        //如果請求成功
        if ($query)
        {
            //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
            if(mysqli_affected_rows($_SESSION['link']) == 1)
            {
            //取得的量大於0代表有資料
            //回傳的 $result 就給 true 代表有該帳號，不可以被新增
            $result = true;
            }
        }
        else
        {
            echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
        }

        //回傳結果
        return $result;
    }
?>