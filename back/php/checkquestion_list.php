<?php
    require_once 'db.php';
    $result=checkquestionlist($_POST["question_check"]);
    if($result){
        echo 'yes';
    }else{
        echo 'no';
    }

    // echo $_POST['question_check'];

    function checkquestionlist($question_check){
        $result=null;
        $sql="SELECT * FROM `question_list` WHERE `name_of_question` = '{$question_check}';";
        $query = mysqli_query($_SESSION['link'], $sql);
        // $query_admin = mysqli_query($_SESSION['link'],$sql_admin);
      
        //如果請求成功
        if ($query)
        {
          //使用 mysqli_num_rows 回傳 $query 請求的結果數量有幾筆，為一筆代表找到會員且密碼正確。
          if(mysqli_num_rows($query) > 0)
          {
            
            $result = true;
          }
        }
        else
        {
          echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
        }
        return $result;
      }

?>