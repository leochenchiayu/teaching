<?php
require_once 'db.php';
// $query = "
// INSERT INTO test 
// (first_name, last_name) 
// VALUES (:first_name, :last_name)
// ";

// for($count = 0; $count<count($_POST['hidden_first_name']); $count++)
// {
// 	$data = array(
// 		':first_name'	=>	$_POST['hidden_first_name'][$count],
// 		':last_name'	=>	$_POST['hidden_last_name'][$count]
// 	);
// 	$statement = $connect->prepare($query);
// 	$statement->execute($data);
// }


// $sql="create table test
//  (no int(5) auto_increment,
//   question text,
//   answer1 text,
//   answer2 text,
//   answer3 text,
//   answer4 text,
//   correct text,
//   primary key (no))";
//   /*執行SQL指令*/
//  mysqli_query($sql)or die("新增失敗!!");
$ok=0;  

$result=create_question($_POST['question_name']);
// echo $result;
if($result){
    echo "成功!!";
    $ok=1;
}else{
    echo "失敗!!";
    $ok=0;
}

if($ok==1){
  $add_question=add_question($_POST['question_name']);
    // if($add_question){
    //     echo "成功!";
    // }else{
    //     echo "失敗";
    // }
}


function create_question($question_name)
{
	//宣告要回傳的結果
    $result = null;
	//先把密碼用md5加密
    // $password = md5($password);
  //將查詢語法當成字串，記錄在$sql變數中
    $sql = "CREATE TABLE `$question_name` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        kind VARCHAR(30) NOT NULL,
        question VARCHAR(30) NOT NULL,
        content VARCHAR(70) NOT NULL
    );";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
    $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
    if ($query)
    {
    // //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
    //     if(mysqli_affected_rows($_SESSION['link']) == 1)
    //     {
    //   //取得的量大於0代表有資料
    //   //回傳的 $result 就給 true 代表有該帳號，不可以被新增
        $result = true;
    //     }
    // }
    // else
    // {
    //     echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }else{
      echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    // if ($_SESSION['link']->query($sql) === TRUE) {
    //     $result=true;
    //   }

  //回傳結果
    return $result;
}

function add_question($question_name)
{
	//宣告要回傳的結果
  $add_question = null;
  $sql2 = "SELECT * FROM `user`;";
  $query2 = mysqli_query($_SESSION['link'], $sql2);
  if ($query2)
  {

    $user_number=mysqli_num_rows($query2);
    mysqli_free_result($query2);
  }
  
  $sql = "INSERT INTO `question_list` (`name_of_question`,`not_done_number_people`) VALUE ('{$question_name}',{$user_number});";

  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
  $query = mysqli_query($_SESSION['link'], $sql);

  //如果請求成功
  if ($query)
  {
    //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
    if(mysqli_affected_rows($_SESSION['link']) > 0)
    {
      //取得的量大於0代表有資料
      //回傳的 $result 就給 true 代表有該帳號，不可以被新增
      $add_question = true;
    }
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }

  //回傳結果
  return $add_question;
}







?>