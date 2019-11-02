<?php


require("../php/dao/daoHelper.php");

/**
 *
 * 获会话
 *
 */

/**
 * 开启会话维持
 */
session_start();


/**
 * 获得用户
 */
$user = !empty($_SESSION["user"]) ? $_SESSION["user"] : null;

/**
 * 获得用户的权限级别
 */
$permissionLevel = !empty($_SESSION["permissionLevel"]) ? $_SESSION["permissionLevel"] : 0;

/**
 * 菜单默认的选中
 */


$defSel = !empty($_GET['defaultSelectIndex']) ? $_GET['defaultSelectIndex'] : "1";

/**
 * 默认存放
 */
$arrMusic = array();

$sql = "select * from music";
$result = MyDao::queryForResult($sql);
$i = 0;
while ($obj = mysqli_fetch_object($result)) {
    $i++;
    if ($i > 6) {
        break;
    }
    $arrMusic[count($arrMusic)] = $obj;
}


$currentMusic = null;

$sql = "select * from music where id=" . $_GET['id'];

$result = MyDao::queryForResult($sql);

$currentMusic = mysqli_fetch_object($result);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>歌曲详细信息的显示界面</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--    <script type="javascript" src="../js/jquery-3.3.1.min.js"></script>-->
    <!--    <script type="javascript" src="../js/bootstrap.min.js"></script>-->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/publish.css" type="text/css">

    <script src="../js/util.js"></script>

    <style>
        /**
  显示内容部分
  */
        div.data {
            clear: both;
        }

        div.data:first-child {
            width: 90%;
            margin: 0 auto;
        }

        .itemRow {
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .ny-content .itemRow div:last-child {
            margin-right: 0px;
        }

        .itemView {
            margin-right: 1%;
            margin-top: 1%;
            margin-bottom: 1%;
            background-color: #ffffff;
            border-radius: 3px;
            border: 1px solid #e6e6e6;
            padding: 20px;
            padding-bottom: 10px;
            width: 32%;
            display: flex;
            flex-direction: column;
        }

        .itemView .head {
            display: flex;

            flex-direction: row;
        }

        .bg {
            width: 160px;
            height: 100px;
            display: inline-block;
            background: url("../image/voice.png");
            background-position: -130px 212px;
        }

        .title {
            font-size: 16px;
            color: #666666;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
        }

        .format {
            font-size: 14px;
            color: #999999;
            margin: 15px 0;
        }

        .button {
            display: inline-block;
            width: 110px;
            height: 30px;
            line-height: 28px;
            background-image: linear-gradient(-90deg, #E1ACF5 0%, #ADD6FF 100%);
            border-radius: 2px;
            text-align: center;
            font-size: 14px;
            color: #FFFFFF;
            cursor: pointer;
            padding: 0px !important;

        }

        /*.glyphicon {*/
        /*    !*position: relative;*!*/
        /*    !*top: -12px;*!*/
        /*    !*font-size: 12px;*!*/
        /*    display: inline-block;*/
        /*    height: 30px;*/

        /*}*/

        .collectLogo {
            display: inline-block;
            height: 30px;
            width: 30px;
            background: url("../image/voice.png");
            background-position: -250px -35px;
        }

        .bofangLogo {
            display: inline-block;
            height: 40px;
            width: 40px;
            background-image: url("../image/voice.png");
            background-position: -30px -125px;
        }

        .progressLogo {
            display: inline-block;
            flex-grow: 1;
            margin-left: 5px;
            margin-right: 5px;
            height: 24px;
            background-image: url("../image/voice.png");
            background-position: 0px -100px;
            background-color: #CCCCCC;
        }

        .bottom {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-top: 10px;
        }


        .formatBox {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        /**
          路径导航的实现
         */
        .breadcrumb {
            background-color: #ffffff;
            border-radius: 0px;
        }

        .container {
            /*background-color: #ffffff;*/
        }

        .contentCenter {
            background: #f5f5f5;
            border-radius: 0px;
        }

        .contentBox {
            box-sizing: border-box;
        }

        .left {
            width: 60%;
            position: relative;
            background-color: #ffffff;
            float: left;
        }

        .left h4 {
            padding: 10px;
        }

        .right {
            float: right;
            width: 38%;
            margin-left: 2%;
        }

        .leftPlayBox {
            width: 100%;
            background-image: url("../image/audio-bg.jpg");
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            height: 400px;
        }


        .leftPlayBox div {
            height: 140px;
            width: 70px;
            background-image: url("../image/voice.png");
            background-position: -140px -290px;
        }

        .leftPlayBox span {
            display: inline-block;
            height: 200px;
            width: 80px;
            background-image: url("../image/voice.png");
            background-position: -300px -260px;
            transform: rotate(-24deg);
            transition: all 0.6s ease-in-out;
            transform-origin: right top;
        }

        .playBox {
            position: absolute;
            display: flex;
            flex-direction: row;
            box-sizing: border-box;
            justify-content: start;
            align-items: center;
            padding: 0 30px;
            z-index: 2;
            top: 380px;
            width: 100%;
            font-size: 18px;
        }

        .playBox span:nth-child(1) {
            display: inline-block;
            height: 60px;
            width: 60px;
            background: url("../image/voice.png");
            background-position: -100px -125px;
        }

        .playBox span:nth-child(3) {
            display: inline-block;
            flex-grow: 1;
            height: 50px;
            margin: 0 10px;
            background: url("../image/voice.png");
            background-position: -0px -202px;
            background-color: #ffffff;
        }


        .tag {
            font-size: 14px;
            font-family: "微软雅黑", Microsoft YaHei, Arial, Verdana;
            color: #999;
        }

        .tag span {
            margin-right: 20px;
        }

        .classfyBox {
            padding: 10px;
        }

        .cl-bbb {
            color: #BBBBBB;
        }


        .right {
        }

        .right div:first-child {
            padding: 15px;
            background-color: #ffffff;
            overflow: hidden;
            clear: both;
        }


        .right div:first-child div:nth-child(2) {
            margin-top: 10px;
            margin-bottom: 10px;

        }

        .right div:first-child div:nth-child(2) div {
            width: 45%;
            text-align: center;
            border: 1px solid #eeeeee;
            border-radius: 2px;
            height: 35px;
            margin: 0px;
            float: left;
        }

        .right div:first-child div:nth-child(2) div:first-child {
            margin-right: 10%;
        }

        .right .copy {
            clear: both;
            margin-top: 15px;
            background-color: #ffffff;
        }

        .div_center {
            display: flex;
            flex-direction: row;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .copy_one1 {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-size: 14px;
        }

        .copy_temp {
            padding: 5px 15px;
        }

        .copy_temp span:first-child {
            color: #999;
            width: 85px;
            display: inline-block;
            padding-left: 0px;
        }

        .touxiang {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>


<nav class="navbar navbar-default ny-nav">
    <div class="box">
        <div>
            <img src="../image/Creative-logo.png" class="logo">
            <span class="fs-24">音频库</span>
        </div>
        <div>
            <input class="cancelBorder">
            <button class="cancelBorder">搜索</button>
        </div>

        <div id="loginModel">


            <!--            <span class="btn btn-primary" data-toggle="modal" data-target="#myModal">登录</span>-->
            <!--            <a href="#">-->
            <!--                <span data-toggle="modal" data-target="#myModal1">注册</span>-->
            <!--            </a>-->

            <!--登录的显示-->
            <!--            <div style="position: relative">-->
            <!--                <img src="../image/gedan2.jpg" class="touxiang-small dropdown-toggle" data-toggle="dropdown">-->
            <!--                &nbsp; &nbsp;-->
            <!--                <a href="#">-->
            <!--                    <span data-toggle="modal" data-target="#myModal1">退出登录</span>-->
            <!--                </a>-->
            <!--                <ul class="dropdown-menu">-->
            <!--                    <li><a href="manager.php">管理</a></li>-->
            <!--                </ul>-->
            <!--            </div>-->

            <?php

            if ($user == null) {

                echo "  <span class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">登录</span>
                    <a href=\"#\">
                    <span data-toggle=\"modal\" data-target=\"#myModal1\">注册</span>
            </a>";
            } else {

                $endLogin = "</div>";

                echo "<div style=\"position: relative\">" .
                    "<img src=\"../image/gedan2.jpg\" class=\"touxiang-small dropdown-toggle\" data-toggle=\"dropdown\">" .
                    "<a href=\"#\" id='exitLogin' data-account=''>" .
                    "<span>退出登录</span>" .
                    "</a>";
                if ($permissionLevel == 1) {//代表的是管理员
                    echo "<ul class=\"dropdown-menu\">" .
                        "<li><a href =\"manager.php\">管理</a></li>" .
                        "</ul>";
                }
                echo $endLogin;
            }

            ?>


        </div>
    </div><!-- /.container-fluid -->
</nav>


<!--
  定义的中间内容部分
-->
<div class="contentCenter">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Index</a></li>
            <li><a href="#">Detail</a></li>
            <li class="active">Data</li>
        </ol>


        <!--定义中间的实际部分-->
        <div class="contentBox">

            <div class="left">
                <?php
                echo "<h4>" . $currentMusic->name . "</h4>"


                ?>
                <!--                <h4>节奏鲜明的轻快伴奏</h4>-->
                <hr/>
                <div class="leftPlayBox">
                    <img src="../image/gedan4.jpg">
                    <div></div>
                    <span></span>
                </div>

                <!--播放进度以及显示-->
                <div class="playBox">
                    <span class="playClick" data-id="<?php echo $currentMusic->id ?>"></span>
                    <span>00:00</span>
                    <span></span>
                    <?php
                    echo "<span>" . $currentMusic->length . "</span>"
                    ?>
                </div>


                <hr/>
                <div class="classfyBox tag">
                    <span>分享:</span>
                    <span>qq音乐:</span>
                    <span>微信朋友圈:</span>
                    <span>qq空间:</span>
                    <span>新浪微博:</span>
                    <span>花瓣:</span>
                </div>

                <div class="classfyBox tag">
                    <span>标签:</span>
                    <span>免费背景音乐</span>
                    <span>其他</span>
                    <span>婚礼配乐</span>
                    <span>影视配乐</span>
                    <span>浪漫背景音乐</span>
                    <span>舒缓配乐</span>
                    <span>舒缓背景音乐</span>

                </div>

                <hr/>

                <p class="cl-bbb classfyBox">
                    版权申明：本网站所有VRF协议音频及素材均由本公司或版权所有人授权发布，如果您侵犯了该音频素材或素材的知识产权，上海韩众网络科技有限公司有权依据著作权侵权惩罚性赔偿标准或最高达50万元人民币的法定标准要求赔偿，且有权不以本网站发布的音频授权价格作为参考标准。
                </p>
            </div>

            <div class="right">
                <div>
                    <button class="btn btn-success btn-block" id="downloadBtn"
                            data-id="<?php echo $currentMusic->id ?>">立即下载
                    </button>
                    <div>
                        <div class="div_center">
                            <span></span><span>赞</span>
                        </div>

                        <div class="div_center">
                            <span></span>收藏
                        </div>
                    </div>
                </div>

                <div class="copy">
                    <div class="copy_one1">
                        <span>音频</span>
                        <span>原创正版授权 </span>
                        <span class="float-right">了解详细>></span>
                    </div>
                    <hr/>
                    <p class="mg-l-10">版权问题</p>
                    <hr/>
                    <div class="copy_temp">
                        <span>授权方式</span>
                        <span>VRF授权(会员免费版权授权)</span>
                    </div>
                    <div class="copy_temp">
                        <span>使用范围</span>
                        <span> 商业用途 授权范围最广的全用途授权</span>
                    </div>

                    <div class="pd-10">
                        <button class="btn  btn-success btn-block">
                            <span>了解商用版权</span>
                        </button>
                    </div>

                    <div class="copy_temp">
                        <span>版权所有</span>
                        <span>摄图网 </span>
                    </div>

                    <div class="mg-t-20">
                        <span class="pd-l-15">配乐信息</span>
                    </div>
                    <hr/>

                    <div class="copy_temp">
                        <span>编号</span>
                        <span><?php echo $currentMusic->classfyId ?></span>
                    </div>

                    <div class="copy_temp">
                        <span>分类</span>
                        <span> 单曲 </span>
                    </div>

                    <div class="copy_temp">
                        <span>文件体积</span>
                        <span><?php echo $currentMusic->size ?></span>
                    </div>

                    <div class="copy_temp">
                        <span>格式</span>
                        <span> mp3</span>
                    </div>

                    <div class="copy_temp">
                        <?php
                        echo "<span>" . $currentMusic->length . "</span>"
                        ?>
                        <span>  02:03</span>
                    </div>

                </div>
            </div>

        </div>


    </div>

</div>


<!--版权等-->
<footer class="nv-copyright">
    <ul>
        <li>关于我们</li>
        <li>版权保障</li>
        <li>VIP介绍</li>
        <li>热门搜索</li>
        <li>官方微博</li>
        <li>联系客户</li>
        <li>客户电话：021-2312234444</li>
    </ul>
    <p>暖云音乐，为你提供高质量音乐在线播放以及下载，免除版权困扰。</p>

    <p class="copyright">
        Copyright 2015摄图网 沪ICP备15050430号 ，
        <span class="logo1">沪公网安备 31011502008153号</span>
        <span class="logo2"></span><span class="logo3"></span>
        用时：0.0319 秒
    </p>
</footer>

<div class="playBar" id="playBar">
    <audio controls autoplay class="bopfangBar" id="audioPlay">
        <source>
    </audio>
    <div class="playInfo">
        <img src="../image/gedan1.jpg">
        <div>
            <span>听到请回答</span>
            <span class="secondFt">鞠婧祎</span>
        </div>
    </div>
</div>


<!--登录的模态框-->
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm login">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    登录
                </h4>
            </div>
            <div class="modal-body">
                <div align="center">
                    <img src="../image/gedan4.jpg" class="touxiang">
                </div>

                <form class="bs-example bs-example-form" role="form">
                    <div class="input-group">
                        <span class="input-group-addon">用户</span>
                        <input type="text" class="form-control" placeholder="用户名" id="login_user">
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon">密码</span>
                        <input type="text" class="form-control" placeholder="密码" id="login_password">
                    </div>
                    <br>

                    <span class="btn btn-info btn-block" id="login_submit">登录</span>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>


<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm register">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    注册
                </h4>
            </div>
            <div class="modal-body">
                <div align="center">
                    <img src="../image/gedan4.jpg" class="touxiang">
                </div>

                <form class="bs-example bs-example-form" role="form">
                    <div class="input-group">
                        <span class="input-group-addon">用户</span>
                        <input type="text" class="form-control" placeholder="用户名" id="register_user">
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon">密码</span>
                        <input type="text" class="form-control" placeholder="密码" id="register_password">
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-addon">密码</span>
                        <input type="text" class="form-control" placeholder="再次输入" id="register_repassword">
                    </div>
                    <br>

                    <span class="btn btn-info btn-block" id="register_submit">注册</span>

                    <input type="reset" value="重置" class="btn btn-success btn-block">
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>


<script>

    /**
     * 文档加载完成后使用
     */
    $(document).ready(function () {


        var account = "<?php echo $user?>";


        $(".playClick").click(function () {

            /**
             * 如果没有登录，就去登录，反之返回当前的MP3的服务器地址
             */
            if (account.trim() == "") {
                $('#myModal').modal('show');
                return;
            }

            //进行播放
            /**
             * 如果没有登录，点击播放无效，会进入登录的界面
             */
            //进行播放
            /**
             * 获得当前播放的数据的源，
             *为了保证我们的数据安全，所以使用这个方式进行操作
             *
             */
            $.ajax({
                type: "GET",
                url: "../php/controll/RequestControll.php",
                data: "action=index&exe=play&id=" + $(this).data("id"),
                success: function (msg) {
                    play(msg);
                }
            })
        })


        /**
         * 上一次播放的音乐
         */
        let previous = null;

        /**
         * 播放的实现，
         *传递的是播放的信息
         * @param music 传递的是音乐的数据
         * @param stop   传递的是否停止当前的播放
         */
        function play(music) {

            // console.log($("#audioPlay")[0].paused)

            if (music != null && $("#audioPlay")[0].paused) {
                $("#playBar").css("bottom", "0px");
                //开始播放
                $("#audioPlay").attr("src", "../music" + music.dataUrl);
                $("#audioPlay")[0].play();
                previous = music.dataUrl;
            } else {
                $("#audioPlay")[0].pause();
                $("#playBar").css("bottom", "-60px");
            }
        }


        /**
         * 立即下载的点击
         */
        $("#downloadBtn").click(function () {
            /**
             * 如果没有登录，就去登录，反之返回当前的MP3的服务器地址
             */
            // alert(account)
            if (account.trim() == "") {
                $('#myModal').modal('show');
                return;
            }
            window.location.href = "../php/controll/RequestControll.php?action=index&exe=download&id=" + $(this).data("id");
        })


        $("#login_submit").click(function () {

            let user = $("#login_user").val();

            let password = $("#login_password").val();


            if (user.trim().length == 0 || password.trim().length == 0) {
                alert("请输入用户名和密码");
            } else {


                // window.location.href = "../php/controll/RequestControll.php?action=index&exe=login&account=" + user + "&password=" + password;


                //提交后台
                $.ajax({
                    type: "GET",
                    url: "../php/controll/RequestControll.php",
                    data: "action=index&exe=login&account=" + user + "&password=" + password,
                    success: function (msg) {
                        if (msg.code == -1) {
                            alert(msg.message)
                        } else if (msg.code == 0) {//代表的是登录成功的执行代码,需要返回account,

                            console.log(msg)

                            var data1 = "<div style=\"position: relative\">" +
                                "<img src =\"../image/gedan2.jpg\" class=\"touxiang-small dropdown-toggle\" data-toggle=\"dropdown\">" +
                                "<a href=\"#\" id='exitLogin' data-account=''>" +
                                "  <span >退出登录</span>" +
                                "</a>";

                            if (msg.user.permissLevel == "1") {//代表的是管理员
                                data1 += "<ul class=\"dropdown-menu\">" +
                                    "<li><a href =\"manager.php\">管理</a></li>" +
                                    "</ul>";
                            }
                            data1 += "</div>";

                            $("#loginModel").empty();

                            $("#loginModel").append(data1)

                            $('#myModal').modal('hide');

                            account = msg.user.account;
                        }
                    }
                })
            }
        })


        $("#exitLogin").click(function () {
            $.ajax({
                type: "GET",
                url: "../php/controll/RequestControll.php",
                data: "action=index&exe=exitLogin",
                success: function (msg) {
                    console.log(msg)
                    if (msg.code == 0) {
                        window.location.reload();
                    }
                }
            })
        })


        /**
         * 注册登录的提交
         */
        $("#register_submit").click(function () {

            let account = $("#register_user").val().trim();
            let password = $("#register_password").val().trim();
            let repassword = $("#register_repassword").val().trim();

            if (password != repassword) {
                alert("两次密码不一致");
                return;
            }
            if (account.length <= 6 || account.length >= 12) {
                alert("账户长度应该在7-12位之间");
                return;
            }
            if (password.length <= 6 || password.length >= 12) {
                alert("密码长度应该在7-12位之间");
                return;
            }

            $.ajax({
                type: "GET",
                url: "../php/controll/RequestControll.php",
                data: "action=index&exe=register&account=" + account + "&password=" + password,
                success: function (msg) {
                    alert(msg.message)
                    if (msg.code == 0) {
                        $("#myModal1").modal("hide");
                    }
                }
            })
        })

    })


</script>


</body>
</html>