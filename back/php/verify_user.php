<?php
require_once 'db.php';

function verify_user($username, $password)
{
  $result = null;
  $password = md5($password);
  $sql = "SELECT * FROM `users` WHERE `username` = '{$username}' AND `password` = '{$password}'";

  $query = mysqli_query($_SESSION['link'], $sql);

  if ($query)
  {
    if(mysqli_num_rows($query) == 1)
    {
      $user = mysqli_fetch_assoc($query);
      
      $_SESSION['is_login'] = TRUE;
      $_SESSION['login_user_id'] = $user['id'];
      $_SESSION["id"] = $user["id"];
      $result = true;
    }
  }
  else
  {
    echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
  }
  return $result;
}






if(verify_user($_POST['un'], $_POST['pw']))
{
	echo 'member';
}else if(verify_admin_user($_POST['un'],$_POST['pw'])){
	echo 'admin';
}else{
	echo 'no';	
}




?>