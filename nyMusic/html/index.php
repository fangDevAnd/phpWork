<?php

//require_once("../php/controll/indexControll/IndexControll.php");


//require("../php/daoService/MusicDaoService.php");

//$musicDao = new MusicDaoService();

//$array = $musicDao->getMusicOffset(MusicDaoService::DEF_INDEX, MusicDaoService::DEF_SIZE);

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


//$exe = $_GET['exe'];
$exe = !empty($_GET["exe"]) ? $_GET["exe"] : "";

$arrMusic = array();

switch ($exe) {

    case "classfy":
        //代表的是分类的操作
        $classfyId = $_GET['classfyId'];

        $sql = "select * from music where classfyId=" . $classfyId;

        $result = MyDao::queryForResult($sql);

        while ($obj = mysqli_fetch_object($result)) {
            $arrMusic[count($arrMusic)] = $obj;
        }


        break;

    case "splitPage":

        //代表的是分页的操作
        break;

    default:
        $sql = "select * from music";
        $result = MyDao::queryForResult($sql);
        while ($obj = mysqli_fetch_object($result)) {
            $arrMusic[count($arrMusic)] = $obj;
        }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>暖云音乐，一个音频下载网站，提供最新的音乐</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--    <script type="javascript" src="../js/jquery-3.3.1.min.js"></script>-->
    <!--    <script type="javascript" src="../js/bootstrap.min.js"></script>-->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/publish.css" type="text/css">


    <style>


        /**

        分类信息部分
        */


        .ny-classfy {
            display: flex;
            flex-direction: row;
            height: 80px;
            align-items: center;
            border-bottom: 1px solid #dddddd;
        }


        .ny-classfy li {
            margin-right: 20px;
            padding: 3px 5px;
            cursor: pointer;
        }

        /**
        显示内容部分
        */
        .ny-content {
            background: #f5f5f5;
            overflow: hidden;
            padding-bottom: 1%;
        }

        .ny-content div.data {
            min-height: 400px;
        }


        .ny-content div.data:first-child {
            width: 90%;
            margin: 0 auto;
        }

        .ny-content .itemRow {
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            /*justify-content: space-between;*/
        }

        .ny-content .itemRow div:last-child {
            margin-right: 0px;
        }

        .ny-content .itemView {
            margin-right: 5%;
            margin-top: 1%;
            margin-bottom: 1%;
            background-color: #ffffff;
            border-radius: 3px;
            border: 1px solid #e6e6e6;
            padding: 20px;
            padding-bottom: 10px;
            width: 21%;
            display: flex;
            flex-direction: column;
        }

        .ny-content .itemView .head {
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
        }

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

        .right {
            display: flex;
            flex-direction: column;
        }

        .formatBox {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }


        /**
        分页的实现
        */

        div.splitPageBox {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }


        .splitPage {
            display: flex;
            flex-direction: row;
        }


        .splitPage span {
            display: inline-block;
            height: 35px;
            line-height: 35px;
            padding: 0 20px;
            margin-right: 20px;
            border-radius: 3px;
            border: 1px solid #CCCCCC;
        }

        .splitPage .btn-input {
            display: inline-block;
            height: 35px;
            width: 50px;
            line-height: 35px;
        }

        .splitPage .btn {
            border: 1px solid #0C77CF;
            color: #0C77CF;
        }


        .secondFt {
            font-size: 12px;
            color: #b0b0b0;
        }

        .login {
            top: 30%;
        }


        .touxiang {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            margin-bottom: 20px;
        }


        .register {
            top: 27%;
        }

        .classfy-list {
            width: 50%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding-left: 20px;
            transition: all 0.2s ease-in-out;
        }

        .classfy-list span {
            margin-right: 30px;
            height: 25px;
            padding: 3px 5px;
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
            margin-bottom: 10px;
        }

    </style>

    <script src="../js/util.js"></script>

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
下面是分类推荐
-->
<div class="ny-classfy container-fluid">
    <div>分类:</div>
    <ul>
        <?php

        $sql = "select * from classfy";

        $result = MyDao::queryForResult($sql);

        $classfyArr = [];

        while ($obj = MyDao::getResultForObjects($result)) {
            $classfyArr[count($classfyArr)] = $obj;
        }

        echo "<li class=\"select\">" . $classfyArr[$defSel - 1]->name . "</li>"

        ?>

        <!--        <li class="select">民族风</li>-->
        <li class="downBtn"><span class="glyphicon glyphicon-chevron-down"></span></li>
    </ul>

</div>


<!--
   显示所有的分类列表数据
   ，默认不显示，，点击才会显示出来
   通过动画显示出来
-->
<div class="classfy-list" style="overflow: hidden" id="classfyList">
    <?php

    for ($i = 0; $i < count($classfyArr); $i++) {
        echo "<span data-id='" . $classfyArr[$i]->id . "' >" . $classfyArr[$i]->name . "</span>";
    }

    ?>
</div>


<!--下面是列表数据的实现-->
<div class="ny-content">
    <!--数据分类-->
    <div class="data" id="musics">


        <?php

        $columnSize = 4;

        for ($i = 0;
             $i < count($arrMusic);
             $i++) {
            if ($i % $columnSize == 0) {
                echo "<div class=\"itemRow\">";
            }


            echo "   <div class=\"itemView\">\n" .
                "                <div class=\"head\">\n" .
                "                    <div>\n" .
                "                        <div class=\"bg\" data-id='" . $arrMusic[$i]->id . "'>\n" .
                "                            <img src=\"../image/south.png\" alt=\"\">\n" .
                "                        </div>\n" .
                "                    </div>\n" .
                "                    <div class=\"right\">\n" .
                "                        <h4 class=\"title\" data-id='" . $arrMusic[$i]->id . "'>" . $arrMusic[$i]->name . "</h4>\n" .
                "                        <div class=\"formatBox\">\n" .
                "                            <span class=\"format\">格式:mp3</span>\n" .
                "                            <span class=\"format td-unline\">详情</span>\n" .
                "                        </div>\n" .
                "                        <div class=\"formatBox\">\n" .
                "                            <div class=\"button\" data-id='" . $arrMusic[$i]->id . "'>\n" .
                "                                <span class=\"glyphicon glyphicon-save\">立即下载</span>\n" .
                "                            </div>\n" .
                "                            <div>\n" .
                "                                <span class=\"collectLogo\"></span>\n" .
                "                            </div>\n" .
                "                        </div>\n" .
                "                    </div>\n" .
                "                </div>\n" .
                "\n" .
                "                <div class=\"bottom\">\n" .
                "                    <span class=\"bofangLogo\"  data-id='" . $arrMusic[$i]->id . "'></span>\n" .
                "                    <span>00:00</span>\n" .
                "                    <span class=\"progressLogo\"></span>\n" .
                "                    <span>" . $arrMusic[$i]->length . "</span>\n" .
                "                </div>\n" .
                "            </div>";
            if ($i == count($arrMusic) - 1 || $i % $columnSize == 3) {
                //代表的是最后一个,和每一行的最后一个
                echo "</div>";
            }
        }


        ?>

        <!--分页的实现
        不实现了，比较忙，早点弄完
        -->
        <!--        <div class="splitPageBox">-->
        <!--            <div class="splitPage">-->
        <!--                <div id="splitPage_dis">-->
        <!--                    <span>1</span>-->
        <!--                    <span>2</span>-->
        <!--                    <span>3</span>-->
        <!--                    <span>...</span>-->
        <!--                    <span>4</span>-->
        <!--                </div>-->
        <!--                <div>-->
        <!--                    <span class="downPage" id="downPage">下一页</span>-->
        <!--                    到第&nbsp;<input type="text" class="btn-input" id="page_input">&nbsp;页-->
        <!--                    <span class="btn" id="page_input_submit">确定</span>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
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
        <audio controls class="bopfangBar" id="audioPlay" autoplay>
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


    <!--
    没有数据提示的modal
    -->

    <div class="modal fade" tabindex="-1" role="dialog" id="noDataTip">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">温馨提示</h4>
                </div>
                <div class="modal-body">
                    <p>没有数据了呢！！！</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>


        $(document).ready(function (e) {


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
                    $("#playBar").css("bottom", 0);
                    //开始播放
                    $("#audioPlay").attr("src", "../music" + music.dataUrl);
                    $("#audioPlay")[0].play();
                    previous = music.dataUrl;
                } else {
                    $("#audioPlay")[0].pause();
                    $("#playBar").css("bottom", -60);
                }
            }


            var defaultSelectIndex = "<?php echo $defSel ?>";


            var currePage = 0;

            /**
             * 不建议使用这个方式
             */
            var account = "<?php echo $user?>";


            var downMenuHeight = $(".classfy-list").css("height");

            $(".classfy-list").css("height", 0);


            setClassfyDefSelect = function () {
                /**
                 * 分类的默认选中
                 */
                $(".classfy-list span:nth-child(" + defaultSelectIndex + ")").addClass("select")


                /**
                 * 设置的是分类的默认显示文本
                 */
                $(".ny-classfy .select").text($(".classfy-list span:(" + defaultSelectIndex + ")").text())

            }


            $(".downBtn").click(function () {
                if ($(".classfy-list").css("height") == "0px") {
                    $(".classfy-list").css("height", downMenuHeight)
                } else {
                    $(".classfy-list").css("height", 0)
                }
            })


            $(".title").hover(function (e) {
                $(this).css("color", "#0C77CF")
            })
            $(".title").mouseleave(function (e) {
                $(this).css("color", "")
            })


            /**
             * 页面跳转点击
             */
            $("#page_input_submit").click(function () {
                let value = parseInt($("#page_input").val());

                value -= 1;

                if (value == currePage || value == 0) {
                    return;
                }
                let pages = musicCount % size == 0 ? musicCount / size : musicCount / size + 1;

                pages = parseInt(pages);

                console.log(pages)

                if (value >= pages) {//15
                    $('#noDataTip').modal('show')
                }


            })


            /**
             * 播放的点击
             */
            $(".bofangLogo").click(function () {


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
             * 进入详情界面的显示
             */
            $("div.itemView .head div.bg").click(function () {

                // alert("爱娜沙发上是否；")

                window.location.href = "./detail.php?id=" + $(this).data("id");


            })

            $("div.itemView .head h4.title").click(function () {
                // alert("爱娜沙发上是否；")
                window.location.href = "./detail.php?id=" + $(this).data("id");
            });


            /**
             * 立即下载的点击
             */
            $(".button").click(function () {
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


            /**
             添加分页的选中
             */
            addSplitSelect = function () {
                $("#splitPage_dis span:nth-child(" + (currePage + 1) + ")").addClass("select");
            }


            /**
             *
             *添加分类的点击事件
             */

            (addClassfyListClick = function () {
                $(".classfy-list span").click(function () {
                    $(".classfy-list span:nth-child(" + defaultSelectIndex + ")").removeClass("select")
                    defaultSelectIndex = $(this).index() + 1;
                    console.log(defaultSelectIndex)
                    $(this).addClass("select")
                    $(".classfy-list").css("height", 0)
                    $(".ny-classfy .select").text($(this).text())


                    window.location.href = "./index.php?exe=classfy&classfyId=" + $(this).data("id") + "&defaultSelectIndex=" + defaultSelectIndex;


                    // $.ajax({
                    //     type: "GET",
                    //     url: "../php/controll/RequestControll.php",
                    //     data: "action=index&exe=classfy&classfyId=" + $(this).data("id"),
                    //     success: function (msg) {
                    //         insertMusicRows(msg, $("#musics"));
                    //     }
                    // })
                })
            }());


            /**
             *
             * 分页显示数据
             * @param 参数是当前页面的缩影
             *
             */
            splitDisData = function (index) {
                $.ajax({
                    type: "GET",
                    url: "../php/controll/RequestControll.php",
                    data: "action=index&exe=splitPage&index=" + index,
                    success: function (msg) {
                        insertMusicRows(msg, $("#musics"));
                    }
                })
            }


            /**
             * 下一页的分页
             */
            $("#downPage").click(function () {

                if (hasDownPage(currePage, musicCount)) {
                    splitDisData(currePage);
                } else {
                    $('#noDataTip').modal('show')
                }

            })


            /**
             * 每一项移入的时候使用的结构
             */
            $("div.itemView").hover(function () {


                // border: 1px solid #e6e6e6;
                $(this).css("border", "1px solid #0C77CF");

            })

            $("div.itemView").mouseleave(function () {

                // border: 1px solid #e6e6e6;
                $(this).css("border", "1px solid #e6e6e6");
            })


            /**
             * 存放的是音乐的数据，每一个都是对象
             */
            let musics;

            /**
             * 存放的是分类
             */
            let classfys;

            /**
             * 存放的是登录的状态对象
             */
            let loginStatus;

            let musicCount;


            /**
             * 发布请求服务器的数据
             */

            // $.ajax({
            //     type: "GET",
            //     url: "../php/controll/RequestControll.php",
            //     data: "action=index&exe=all",
            //     success: function (msg) {
            //         console.log(msg)
            //         musics = msg.arrays;
            //         classfys = msg.classfys;
            //         loginStatus = msg.status;
            //         musicCount = msg.musicListCount;
            //
            //
            //
            //          insertMusicRows(musics, $("#musics"));
            //
            //         updateLoginStatus(loginStatus);
            //
            //         updateClassfy(classfys);
            //
            //         downMenuHeight = $(".classfy-list").css("height");
            //
            //         $(".classfy-list").css("height", 0);
            //
            //         updateSplitPage(musicCount);
            //
            //         addSplitSelect();
            //
            //         setClassfyDefSelect();
            //
            //         addClassfyListClick();
            //
            //
            //     }
            // });


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


            /**
             * 退出登录
             */
            // function exitLogin() {
            //     $.ajax({
            //         type: "GET",
            //         url: "../php/controll/RequestControll.php",
            //         data: "action=index&exe=exitLogin",
            //         success: function (msg) {
            //             if (msg.code == 0) {
            //                 window.location.reload();
            //             }
            //         }
            //     }
            // }

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


        })


    </script>

    <script>

        /**
         * 开发文档，我们的服务器通信的接口是下面两个字段
         * action  代表的是路径
         * exe     代表的是执行的操作
         *
         *
         *
         * 之前开发使用的是ajax的方式  ，造成也饿面卡顿的现象，现在改为 php动态渲染的方式实现
         *
         *
         *
         *
         *
         */


    </script>


</body>
</html>