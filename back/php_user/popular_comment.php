<?php
    require_once '../php/db.php';
    require_once '../php/functions.php';
    $datas = select_popular();
    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
    {
	    //直接轉跳到 login.php
	    header("Location: login.php?error=1");
    }
    $info = get_user_info();
    if(!empty($info)){
        foreach($info as $infos){
            $user=$infos['username'];
            $level=$infos['userlevel'];
            $id = $infos['id'];
        } 
    }
    
    // $prefer = select_prefer();
    
    // if(!empty($prefer)){
    //     for($i=0;$i++;$prefer.length()){
    //         echo $i;
    //     } 
    // }
    // echo $like;
    // if(!empty($prefer)){
    //         print_r($prefer) ;
    // }
    // echo $like;
                                  

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../LOGO.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../hamburger.css">
</head>
<style>
    /*hamburger*/
    
    body{
        background:#f3d5b8;
    }
    .bgimg {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: -999;
    }    
    .bgimg img {
        min-height: 100%;
        width: 100%;
    }
    .clearfix::after {
        content:"";
        display: block;
        clear: both;
    }

    .hamburger {
        float: right;
    }
    
    .collapse{
        
        margin:0px;
        padding:0px;
        border:0px;
        box-sizing:border-box;
        
    }
    
    
    .logo>a>img{
        width: 60px;
        height: 60px;
    }
    
    .bg{
        background:skyblue;
        width:100%;
        height:100%;
    }
    .g1{
        position:relative;
        width: 70%;
        height: 100%;
        background:white;
        border-radius:10px;
        padding:15px;
        margin:auto;
    }
    .bold{
        font-weight:bold;
    }
    #bg{
        width:100%;
        height:100%;
        padding-top: 100px;
        padding-bottom: 100px;
    }
    .comment_list{
        width:100%;
        height:100%;
        background:white;
    }
    footer{
        position: absolute;
        bottom: 0;
    /* 展開footer寬度 */
        width: 100%;
        margin-bottom:0px;
        padding:0px;
        padding-top:5px;
    }
    .mycomment{
        margin:0 auto;
        width:100%;
    }

    
    .menu>ul>li>a {
        width: auto;
        text-align: center;
    }
    .menu>ul>li>a:hover {
        width: auto;
        color:white;
        text-decoration: none;
        text-align: center;
    }
    
    

    @media(min-width:960px){
        .hamburger {
            display: none;
        }
        
        .collapse{
            display:block;
        }
        .logo{
            float:left;
        }
        .nav li{
            float:left;
        }
        .collapse{
            float:left;
        }
        .menu>ul>li>ul{
            width:100px;
            display:block;  
        }
    }
    /*endhamburger*/
    nav{
        background:#747340;
    }


div>a>img:nth-last-of-type(1){
            display:none;
        }
</style>
<body>
    <div class="bgimg">
        <img src="https://cp.cw1.tw/files/md5/6a/8c/6a8cef01641151ec27160de6865241d3-192964.jpg" alt="">
    </div>
    <nav class="full-width clearfix">
        <div class="fixed-width">
            <div class="hamburger"><span></span></div>
            <div class="logo">
                <a href="#"><img style="display:block;" src="../LOGO.png" alt=""></a>
            </div>
            <!-- <div class="collapse"> -->
            <div class="menu">
                    <ul>
                        <li class="t-center down2"><a class="mt-auto" href="memberinfo.php">我的資料</a>
                            
                        </li>
                        <li class="t-center down1"><a class="mt-auto" href="comment_list.php">留言列</a>
                        </li>
                        <li class="t-center"><a class="mt-auto" href="popular_comment.php">人氣留言</a></li>
                        <li class="t-center down3"><a class="mt-auto" href="member.php">成員列表</a></li>
                        <li class="t-center down4"><a class="mt-auto" href="comment.php">我要留言</a>
                        <li class="t-center down4"><a class="mt-auto" href="commentedit.php">我的留言</a>
                            
                        </li>
                    </ul>
                </div>
            <!-- </div> -->
                <div class="login">
                    <ul>
                        <li class="t-center username"><a><?php echo $level=='admin'?'管理員:':'會員';?><?php echo $user,"您好!";?></a></li>
                        <li class="t-center"><a href="../php/logout.php">登出</a></li>
                    </ul>
                </div>
        </div>
        <input type="hidden" class="user" value="<?php echo $user;?>">
        <input type="hidden" class="userid" value="<?php echo $id;?>">
    </nav>
    <div class="full-width" id="bg">
        <div class="fixed-width">
                <h1 class="t-center mb-7 bold">人氣留言</h1>
                <hr>
                <?php $p=0;?>
            <?php if(!empty($datas)):?>
							<?php foreach($datas as $row):?>
							<?php 
								//處理 摘要
								//去除所有html標籤
								// $abstract = strip_tags($row['comment']);
								//取得100個字
                                $abstract = nl2br($row['comment']);
                                if($p==2){
                                    $p=0;
                                }
                                $comment_id = $row['id']
                            ?>

							<!-- 使用 bootstrap 的 panel 來呈現 http://getbootstrap.com/components/#panels-->
                            <?php //if($p==0){?>    
                                <!-- <div class="col-xl-20 col-20"> -->
                            <?php //}?>        
                                    <div class="col-xl-20 col-20 t-center">
                                        <div class="g1">
                                            <div class="alert alert-danger" role="alert">
                                                <?php $comment_id=$row['id'];
                                                    // echo $comment_id;
                                                ?>
                                                得票數:<?php echo $row['score'];?>
                                            </div>
                                            <div class="alert alert-info" role="alert">
                                                喜歡的有:<?php 
                                                    
  
                                                    //將查詢語法當成字串，記錄在$sql變數中
                                                    $sql = "SELECT * FROM `prefer` WHERE `comment_id`= $comment_id AND `prefer` = 1;";
                                                    // $sql = "SELECT COUNT(*) AS TOTAL ,`comment_id` FROM `prefer` WHERE `prefer` = 1 GROUP BY `comment_id` ORDER BY TOTAL DESC LIMIT 3;"; // ORDER BY `create_date` DESC 代表是排序，使用 `create_date` 這欄位， DESC 是從最大到最小(最新到最舊)
                                                    //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
                                                    $query = mysqli_query($_SESSION['link'], $sql);
                                                    // echo mysqli_num_rows($query);
                                                    while ($popular = mysqli_fetch_array($query))
                                                    {
                                                        echo $popular['creater']," ";
                                                    }
                                                    if(mysqli_num_rows($query)<1){
                                                        echo "沒有人!!";
                                                    }
                                                
                                                ?>
                                            </div>
                                            <h2><?php echo $row['title']?></h2><h4 class="bold"><?php echo $row['poster']?></h4>
                                            <p class="t-left m-4" style="line-height:30px"><?php echo $abstract?></p>
                                        </div>
                                    </div>
                                    <?php //$p=$p+1; ?>
                            <?php //if($p==2){?>    
                                <!-- </div> -->
                            <?php //}?>
                            
						    <?php endforeach; ?>
						<?php else: ?>
							<h3 class="text-center">尚無留言</h3>
					    <?php endif; ?>
        </div>
    </div>
    <?php
    ?>
    <?php  // echo $like; ?>
    <!-- <footer>
        2020 &copy copyright
    </footer> -->
    

   
    

    

    
    <script>
       

        $(document).ready(function(){
            $(".hamburger").click(function(){
                $(this).toggleClass('hamburger-x');
                $(".menu").slideToggle();
            })

            $(".down1").click(function(){
                $(".show1").slideToggle(1500);
            })
            
            $(".down2").click(function(){
                $(".show2").slideToggle();
            })

            $(window).resize/*控制畫面大小*/(function(){
                let w =$(window).width();
                console.log(w);
                if(w>960){
                    $('.menu').show();
                }else{
                    $('.menu').hide();
                    $('.hamburger').removeClass('hamburger-x');
                }
            })

            
            
            
            
        })
    </script>
</body>

</html>