<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once '../php/db.php';
require_once '../php/functions.php';
//print_r($_SESSION); //查看目前session內容

//如過沒有 $_SESSION['is_login'] 這個值，或者 $_SESSION['is_login'] 為 false 都代表沒登入
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	//直接轉跳到 login.php
	header("Location: login.php?error=1");
}

$info = get_user_info();
    if(!empty($info)){
        foreach($info as $infos){
            $user=$infos['username'];
            $id = $infos['id'];
        } 
    }

?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言區</title>
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
    <!-- 頁首 -->




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
                        <li class="t-center username"><a><?php echo $user,"您好!";?></a></li>
                        <li class="t-center"><a href="../php/logout.php">登出</a></li>
                    </ul>
                </div>
        </div>
        <input type="hidden" class="user" value="<?php echo $user;?>">
        <input type="hidden" class="userid" value="<?php echo $id;?>">
    </nav>
    <!-- 網站內容 -->
    <input type="hidden" class="user" value="<?php echo $user;?>">
    <input type="hidden" class="userid" value="<?php echo $id;?>">
    <div class="full-width mt-5">
        <div class="fixed-width">
          <div class="container">
            <h2 class="t-center mb-4"><strong>留言板</strong></h2>
            <!-- <p>請輸入您的留言</p> -->
            <form class="submit">
                <div class="form-group">
                  <label for="title">標題 </label>
                  <input type="input" class="form-control" cols="2" id="title" value="" required>
                </div>
                <div class="form-group">
                  <label for="content">內容</label>
                  <textarea type="input" class="form-control" rows="5" id="content" required></textarea>
              </div> 
              <button class="btn btn-info">送出</button>
            </form>
          </div>
      </div>
    </div>
  </body>
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
              $.ajax({
                type:"POST",
                url:"../php/addcomment.php",
                data:{
                  title:$("#title").val(),
                  content:$("#content").val(),
                  user:$(".user").val(),
                  userid:$(".userid").val()
                },
                dataType:'html'
              }).done(function(data){
                  if(data=='yes'){
                      alert("成功!");
                      window.location.href = "comment_list.php";
                  }else{
                      alert('失敗!');
                      console.log(data);
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
</html>