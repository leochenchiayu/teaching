<?php
    require_once '../php/db.php';
    require_once '../php/functions.php';
    $datas = show_member();
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
    .member{
        width:100%;
    }
    .bar{
        width:40%;    
    }
    .table{
        width:70%;
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
            <div class="mycomment t-center mb-5">
                
                <h1 class="t-center mb-7 bold">成員列表</h1>
                <?php $admin=0;
                      $member=0;
                ?>
                <table class="table alert alert-dark p-10 m-auto mt-5">
                <thead>
                    <tr>
                    <th class="t-center" scope="col">使用者</th>
                    <th class="t-center" scope="col">權限</th>
                    <?php if($level=='admin'){ ?>
                        <th class="t-center" scope="col">會員資料編輯</th>
                    <?php }?>
                    <!-- <th scope="col">Handle</th> -->
                    </tr>
                </thead>
                <tbody>
            <?php if(!empty($datas)):?>
                            <?php foreach($datas as $row):?>
                                <?php if($row["userlevel"]=='admin'){
                                        $admin = $admin + 1;
                                    }else{
                                        $member = $member + 1;
                                    }
                                ?>
                                <!-- <div class="full-width"> -->
                                    <!-- <div class="fixed-width"> -->
                                    <tr>
                                        <th class="t-center"><?php echo $row['username'];?></th>
                                        <th class="t-center"><?php echo $row['userlevel']=='admin'?'管理員':'一般會員';?></th>
                                        <?php if($level=='admin'){ ?>
                                            <th class="t-center" scope="row">
                                                <a class="alert alert-info mt-2 mb-2 bar m-auto" href="member_edit.php">編輯</a>
                                                <a class="alert alert-danger mt-2 mb-2 bar m-auto" href="javascript:void(0)">刪除</a>
                                            </th>
                                        <?php }?>
                                    </tr>
                                    <!-- </div> -->
                                <!-- </div> -->
                               
                            <?php endforeach; ?>
                            </tbody>
                        </table>
						<?php else: ?>
							<h3 class="text-center">尚無成員</h3>
                        <?php endif; ?>
                        <div class="alert alert-success t-center m-auto l-5 r-5 mt-4 bar" style="width:70%;" role="alert">
                            全部成員有<?php echo $admin+$member;?>人，管理員有<?php echo $admin;?>人，一般成員有<?php echo $member;?>人
                        </div>
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

