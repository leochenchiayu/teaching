<?php
    require_once '../php/db.php';
    require_once '../php/functions.php';
    $datas = get_publish_comment();
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
    // echo $_SESSION["id"];
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
    .menu>ul>li>ul{
        display:none;
        
    }

    .menu>ul>li>ul>li{
        overflow:hidden;
        background-color:#747340;
        width: 100%;
        /* display: block; */
        /* transition:10s; */
        
    }
    
    .menu>ul>li>ul>li>a{
        display:block;
        text-decoration:none;
    }

    .menu>ul>.down1>.show1>.show3>ul{
        visibility: hidden;
        position:absolute;
        width:130px;
        left: 100px;
        /*border:1px solid;*/
    }
    .menu>ul>.down1>.show1>.show3:hover>ul{
        visibility: visible;
        top:50px;
        
    }
    .menu>ul>.down1>.show1>.show3:hover li{
        transition:background-color 3s ease;
    }
    
    .menu>ul>.down1>.show1>.show3>ul>li{
        transition: height 0.5s;
        text-align: center;
        clear: both;
        width: 100%;
    }
    .menu>ul>.down1>.show1>.show3>ul>li:hover{
        background: #fff5bb4f;
    }
    .menu>ul>.down1>.show1>.show3>ul>li>a{
        display:block;
    }

    .menu>ul>.down1>.show1>.show4>ul{
        visibility: hidden;
        position:absolute;
        width:130px;
        left: 100px;
        /*border:1px solid;*/
    }
    .menu>ul>.down1>.show1>.show4:hover>ul{
        visibility: visible;
        top:100px;
        
    }
    .menu>ul>.down1>.show1>.show4>ul>li{
        transition: height 0.5s;
        text-align: center;
        clear: both;
        width: 100%;
    }
    .menu>ul>.down1>.show1>.show4>ul>li:hover{
        background-color: #fff5bb4f;
    }
    .menu>ul>.down1>.show1>.show4>ul>li>a{
        display:block;
        margin:auto;
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
    


    

    
}
</style>
<body>
    <!-- <div class="load">
        <div class="loader"></div>
    </div> -->

    <!-- <div class="wrapper-loading">
        <div class="content-loading">

        <div class="loading"><img src="../Preloader_1.gif" width="150px"></div>

            <div class="loading-bar-holder">
                <div class="loading-bar">
                    <div class="loading-bar-shiny">

                    </div>
      </div>
      </div>

    </div>

  </div> -->
    
  
  
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
    <div class="full-width" id="bg">
        <div class="fixed-width">
            <h2 class="t-center"><strong>留言列</strong></h2>
            <hr>    
            <?php $p=0;?>
            <?php if(!empty($datas)):?>
							<?php foreach($datas as $row):?>
							<?php 
								//處理 摘要
								//去除所有html標籤
								$abstract = nl2br($row['comment']);
								//取得100個字
                                // $abstract = mb_substr($abstract, 0, 100, "UTF-8");
                                if($p==2){
                                    $p=0;
                                }
                                $comment_id = $row['id']
                            ?>

							<!-- 使用 bootstrap 的 panel 來呈現 http://getbootstrap.com/components/#panels-->
                            <?php if($p==0){?>    
                                <div class="col-xl-20 col-20">
                            <?php }?>        
                                    <div class="col-lg-10 t-center">
                                        <div class="g1">
                                            <h2><?php echo $row['title']?></h2><h4 class="bold"><?php echo $row['username']?></h4>
                                            <p class="t-left"><?php echo $abstract?></p>
                                        </div>
                                        <!-- <form action="">
                                            <input type="checkbox" class="checkbox" id="" name="prefer" value="yes" 
                                            >
                                            <label for="prefer"> 我喜歡</label><br>
                                        </form> -->
                                        <form>
                                            <input type="checkbox" class="check" id="<?php echo $row['id'];?>" name="vehicle1" value="Bike" 
                                            <?php
                                                $chk = 0;
                                                $sql = "SELECT * FROM prefer WHERE post_id = $comment_id AND user_id = '$user';"; 
                                                $result = mysqli_query($_SESSION['link'], $sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    $chk = 1;
                                                    while($prefer = mysqli_fetch_array($result)){
                                                        $like = $prefer['prefer'];
                                                    }
                                                    mysqli_free_result($result);
                                                }else{
                                                    echo "無資料!";
                                                }
                                                    if($chk == 1){
                                                        echo $like==1?'checked':'';
                                                    }
                                            ?>>
                                            <label for="vehicle1">我喜歡</label><br>
                                        </form>
                                    </div>
                                    <?php $p=$p+1; ?>
                            <?php if($p==2){?>    
                                </div>
                            <?php }?>
                            
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
    </footer>
     -->

   
    

    

    
    <script>
    //    window.onload = function(){
    //        $(".load").fadeOut(8000);
    //        $(".loader").fadeOut(6000);
    //    }
    setTimeout(function(){
      $(".wrapper-loading").hide();
            },8000)
            $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 8000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                    if ($(this).html() < 10) {
                    $(this).html('0' + Math.ceil(now));
                    }
                    if ($(this).html() == 100) {
                    $(".init").text("done");
                    }
                }
            });
        });

       

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

            // $(window).load(function(){
            //     $(".load").hide();
            // })

            
            
            $(".check").change(function() {
                // alert(
                //         $(this).attr("id")+"|"+
                //         $(".user").val()+"|"+
                //         $(".userid").val()+
                //         $(this).is(":checked")
                //         );
                // var x=$(this).is(":checked");
                // alert(x);
                if($(this).is(":checked")==true){
                
                    $.ajax({
                        type:"POST",
                        url:"../php/prefer.php",
                        data:{
                            count:1,
                            like:1,
                            comment_id:$(this).attr("id"),
                            user:$(".user").val(),
                            user_id:$(".userid").val()
                        },
                        dataType:'html'
                    }).done(function(data){
                        console.log(data);
                        // if(data=='update'){
                        //     alert("###");
                        // }else if(data=='yes'){
                        //     alert("XXX");
                        // }else{
                        //     alert("...");
                        // }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        //失敗的時候
                            alert("有錯誤產生，請看 console log");
                            console.log(jqXHR.responseText);
                        });
                        return false;
                }else{
                    $.ajax({
                        type:"POST",
                        url:"../php/prefer.php",
                        data:{
                            count:-1,
                            like:0,
                            comment_id:$(this).attr("id"),
                            user:$(".user").val(),
                            user_id:$(".userid").val()
                        },
                        dataType:'html'
                    }).done(function(data){
                    console.log(data);
                    // if(data=='update'){
                    //     alert("###");
                    // }else if(data=='yes'){
                    //     alert("XXX");
                    // }else{
                    //     alert("...");
                    // }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        //失敗的時候
                            alert("有錯誤產生，請看 console log");
                            console.log(jqXHR.responseText);
                        });
                        return false;
                    }
                });
    	
            
        })
    </script>
</body>

</html>