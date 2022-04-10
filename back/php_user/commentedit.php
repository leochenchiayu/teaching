<?php
    require_once '../php/db.php';
    require_once '../php/functions.php';
    $datas = get_personalcomment();
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
        width: 100%;
        height: 100%;
        background:white;
        border-radius:10px;
        padding:15px;
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
    a:hover{
        text-decoration:none;
        color:white;
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
    <input type="hidden" class="id" value="<?php echo $id;?>">
    <div class="full-width" id="bg">
        <div class="fixed-width">
            <div class="mycomment t-center mb-5">
                <!-- <a class="btn" href="comment_list.php">會員留言</a> -->
            </div>
                <h1 class="t-center mb-7 bold">我的留言</h1>
                <hr>
            <?php if(!empty($datas)):?>
                        <?php $p=0;?>
							<?php foreach($datas as $row):?>
							<?php 
								//處理 摘要
								//去除所有html標籤
								$abstract = nl2br($row['comment']);
								//取得100個字
                                $abstract = mb_substr($abstract, 0, 100, "UTF-8");
                                
                            ?>

                                    
							<!-- 使用 bootstrap 的 panel 來呈現 http://getbootstrap.com/components/#panels-->
                            <div class="container mb-3">
                                <!-- <p>請輸入您的留言</p> -->
                                <form class="submit" data-id="<?php echo $row['id'];?>">
                                    <div class="form-group" id="mytitle">
                                        <label for="title">標題 </label>
                                        <input type="input" class="form-control" cols="2" id="title" value="<?php echo $row['title'];?>" required>
                                    </div>
                                    <div class="form-group" id="mycontent">
                                        <label for="content">內容</label>
                                        <textarea type="input" class="form-control" rows="5" id="content" required><?php echo $row['comment']; ?></textarea>
                                    </div>
                                    <!-- <input type="hidden" class="commentid">  -->
                                    <button class="alert alert-info">編輯</button>
                                    <a class="del alert alert-danger" href="javascript:void(0)" data-id="<?php echo $row['id']?>">刪除</a>
                                </form>
                            </div>
                            <hr>
						    <?php endforeach; ?>
						<?php else: ?>
							<h3 class="text-center">尚無留言</h3>
					    <?php endif; ?>
        </div>
    </div>
    <?php
        // echo $row['id'];
    
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

            $("form.submit").submit(function(){
                // alert(
                //     $(this).children("#mytitle").children("#title").val() +
                //     $(this).children("#mycontent").children("#content").val() 
                //     // $(".form-control").attr("id")
                // );

                //     alert($(this).attr("data-id"));
                // alert()
                // alert("XXX");
                $.ajax({
                    type:"POST",
                    url:"../php/commentedit.php",
                    data:{
                        id:$(this).attr("data-id"),
                        title:$(this).children("#mytitle").children("#title").val(),
                        content:$(this).children("#mycontent").children("#content").val()
                    },
                    dataType:'html'
                }).done(function(data){
                    if(data=='yes'){
                        alert("編輯成功!!");
                    }
                }).fail(function(jqXHR,textStatus,errorThrown){
                        alert("有錯誤，看console.log");
                        console.log(jqXHR.requestText);
                    });
                    return false;
            });    

              $("a.del").click(function(){
    			//宣告變數
    			// var c = confirm("您確定要刪除嗎？"),
                        var this_tr = $(this).parent().parent()
                        console.log(this_tr);
    			
    				$.ajax({
                        type : "POST",
                        url : "../php/delete_comment.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
                        data : {
                        id : $(this).attr("data-id") //文章id
                    },
                    dataType : 'html' //設定該網頁回應的會是 html 格式
                }).done(function(data) {
            //成功的時候
            console.log(data);
            if(data == "yes" || data=='yes!!')
            {
              //註冊新增成功，轉跳到登入頁面。
              this_tr.fadeOut();
            }
            else
            {
              console.log("刪除錯誤:"+data);
            }
            
          }).fail(function(jqXHR, textStatus, errorThrown) {
            //失敗的時候
            alert("有錯誤產生，請看 console log");
            console.log(jqXHR.responseText);
          });
    			
					
          
    			return false;
    		});      
        })
    </script>
</body>

</html>