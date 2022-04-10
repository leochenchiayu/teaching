<?php
    require_once '../php/db.php';
    require_once '../php/functions.php';
    if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
        header("Location:comment_list.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../LOGO.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../hamburger.css">
    <link href="https://fonts.googleapis.com/css2?family=Butterfly+Kids&display=swap" rel="stylesheet">
</head>
<style>
    /*hamburger*/
    
    body{
        
        width:100%;
        height:100%;
        position:absolute;
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
    #bg{
        width:100%;
        height:100%;
    }
    .loginform{
        margin:auto;
        width:300px;
    }
    form{
        
        background:#d6d59e;
        padding:20px;
        animation: slide-in-elliptic-top-bck 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        /* animation-name:gogo; */
        /* animation-iteration-count: infinite; */
        /* animation-duration: 1s;
        animation-timing-function: cubic-bezier(1, 3.66, 0.63,-1.09); */
        /* animation-direction: alternate-reverse; */
        /* animation-fill-mode: both;*/
        box-shadow:8px 6px 2px #776e3a;
        /* transition: all 1s cubic-bezier(1, 2.68, 0.27,-0.88) .2s ; */
    }
    /* @keyframes gogo{
        0%{
            transform:rotate3d(360,45,30,360deg);
        } */
        /* 50%{
            transform:rotate3d(-360,-45,30,-360deg)
        } */
        /* 100%{
            transform:rotate3d(0,0,0,0deg);
        }
    } */

    @keyframes slide-in-elliptic-top-bck {
    0% {
                transform: translateY(-600px) rotateX(30deg) scale(6.5);
                transform-origin: 50% 200%;
                opacity: 0;
    }
    100% {
                transform: translateY(0) rotateX(0) scale(1);
                transform-origin: 50% -500px;
                opacity: 1;
    }
}


    
    form:hover{
        /* transform:rotate3d(360,45,30,360deg)scale(1.5); */
    }
    footer{
        position: relative;
        bottom: 0;
    /* 展開footer寬度 */
        width: 100%;
        margin-bottom:0px;
        padding:0px;
        padding-top:5px;
    }

    .loginmt{
        margin-top:5rem!important;
    }
    nav{
        background:#747340;
    }
    
    .loginen{
        font-family: 'Butterfly Kids', cursive;
        font-weight:900;
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
                <a href="../index.html"><img style="display:block;" src="../LOGO.png" alt=""></a>
            </div>
            <!-- <div class="collapse"> -->
                
            <!-- </div> -->
                
        </div>
    </nav>
    <div class="full-width" id="bg">
        <div class="fixed-width clearfix loginmt">
            <div class="col-xl-20 col-20">
                <div class="loginform">
                    <form class="login">
                        <h1 align="center"><strong>會員登入</strong> </h1>
                        <h1 align="center" class="loginen">login</h1>
                        <?php if(isset($_GET["error"]) && ($_GET["error"]=="1")){?>
                            <div class="alert alert-danger t-center" role="alert">
                                進入前請先登入!!
                            </div>
                        <?php } ?>
                        <div class="form-group mt-8">
                            <label for="exampleInputEmail1">帳號</label>
                            <input type="account" class="form-control" id="account" aria-describedby="emailHelp" value="" placeholder="請輸入帳號">
                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">密碼</label>
                            <input type="password" class="form-control" id="password" value="" placeholder="請輸入密碼">
                        </div>
                        <button type="submit" class="btn btn-primary">確認</button>     
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        2020 &copy copyright
    </footer>
    

   
    

    

    
    <script>
       

        $(document).ready(function(){
            $(".hamburger").click(function(){
                $(this).toggleClass('hamburger-x');
                $(".menu").slideToggle();
            })

            $(".down1").click(function(){
                $(".show1").slideToggle("slow");
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

            $("form.login").submit(function(){
                // console.log($("#account").val());
                $.ajax({
                    type : "POST",
                    url : "../php/verify_user.php", //因為此 login.php 是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 verify_user.php
                    data : {
                        un : $("#account").val(), //使用者帳號
                        pw : $("#password").val() //使用者密碼
                    },
                    dataType : 'html' //設定該網頁回應的會是 html 格式
                }).done(function(data) {
                    //成功的時候
                    console.log(data);
                    if(data == "member")
                    {
                    //註冊新增成功，轉跳到登入頁面。
                    window.location.href = "comment_list.php"; //因為目前的 login.php 跟後端的 index.php 首頁在同一資料夾，所以直接叫他就好
                    }
                    else if(data == "admin")
                    {
                        window.location.href = "comment_list.php";
                    }else{
                        alert("登入失敗，請確認帳號密碼");
                    }
                    
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
                    //回傳 false 為了要阻止 from 繼續送出去。由上方ajax處理即可
                    return false;
				});

            
        })
    </script>
</body>

</html>