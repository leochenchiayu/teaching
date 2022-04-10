<?php
    // require_once 'functions.php';
    // $error=0; 
    require_once 'db.php';
    $comment_id = $_POST["comment_id"];
    echo $_SESSION["id"];
    // echo $comment_id;
    $sql = "SELECT * FROM prefer WHERE post_id = $comment_id AND user_id = {$_SESSION['id']}";
    $query = mysqli_query($_SESSION['link'], $sql);
    $cnt = mysqli_num_rows($query);
    if($cnt > 0){
        $sql = "DELETE FROM prefer WHERE post_id = $comment_id AND user_id = {$_SESSION['id']}";
    }else{
        $sql = "INSERT INTO prefer (post_id,user_id) VALUES( $comment_id,{$_SESSION['id']}) ";
    }

    mysqli_query($_SESSION['link'],$sql);

    


?>