<?php

require_once("../php/dao/daoHelper.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--    <script type="javascript" src="../js/jquery-3.3.1.min.js"></script>-->
    <!--    <script type="javascript" src="../js/bootstrap.min.js"></script>-->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/publish.css" type="text/css">
    <script src="../js/util.js"></script>
    <title>Title</title>
    <style>

        .container-fluid {
            margin: 0px -15px;
        }

        .navbar-right {
            margin-right: 20px;
        }

        .navbar {
            margin-bottom: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .navbar-header {
            margin-left: 20px !important;
        }

        .navbar-right {
            position: relative;
            top: 5px;
            color: #ffffff;
        }


        .left {
            width: 200px;
            background-color: #1B1B1B;
            position: absolute;
            height: 100%;
        }

        .content {
            display: flex;
            flex-direction: row;
        }

        .list-group {
            width: 100%;
        }


        .list-group-item {
            border-radius: 0px !important;
            background: #1B1B1B;
            color: #ffffff;
            border: none;
        }

        .right {
            height: 100%;
            margin-left: 200px;
            flex-grow: 1;
            padding: 20px;
        }

        th, td {
            text-align: center;
        }

        .title_one {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            font-size: 40px;
            padding-bottom: 20px;
        }

        .title_one span {
            margin-right: 50px;
            width: 40px;
            height: 40px;
            background-color: #0C77CF;
            text-align: center;
            color: #ffffff;
            border-radius: 50%;
            line-height: 40px;
        }

        .downBox {
            height: 300px;
            width: 60%;
            border: 1px dashed #CCCCCC;
            text-align: center;
        }

        .downBox form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }


        .download {
            margin-top: 20px;
            width: 140px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .down1 {
            position: relative;
            top: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-control, .btn {
            border-radius: 0px;
        }


        .button{
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


        .five_box {

            width: 40%;


        }

        .bg-success {
            background-color: #4cae4c !important;
        }

        .right .list-group-item {
            color: #111111;
            background-color: #ffffff;

        }


    </style>

</head>
<body>

<div class="container-fluid">

    <!--头部-->
    <div>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        暖云音乐
                    </a>
                </div>

                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-success">查找</button>
                </form>


                <ul class="nav navbar-nav navbar-right">
                    <!--登录的显示-->
                    <img src="../image/gedan2.jpg" class="touxiang-small dropdown-toggle" data-toggle="dropdown">
                    &nbsp;
                    <a href="#" id="exitLogin">
                        <span>退出登录</span>
                    </a>
                </ul>
            </div>
        </nav>
    </div>

    <!--
    中间内容
    -->
    <div class="content">
        <!--左边菜单-->
        <div class="left">

            <ul class="list-group">
                <li class="list-group-item">音乐信息管理</li>
                <li class="list-group-item">音乐类别管理</li>
                <li class="list-group-item">媒体上传</li>
                <li class="list-group-item">媒体管理</li>
                <li class="list-group-item">添加音乐信息</li>
            </ul>

        </div>


        <!--右边界面实现-->

        <div class="right">

            <!--音乐信息管理-->
            <div class="one">

                <div class="title_one">
                    <h3>音乐信息管理</h3>
                    <span class="addNew musicInfoAdd">+</span>
                </div>


                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>名字</th>
                        <th>大小</th>
                        <th>长度</th>
                        <th>作者</th>
                        <th>分类id</th>
                        <th>编辑</th>
                        <th>删除</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /**
                     * 查询本地的音乐信息
                     */
                    $arrMusic = array();
                    $sql = "select * from music";
                    $result = MyDao::queryForResult($sql);
                    while ($obj = mysqli_fetch_object($result)) {
                        $arrMusic[count($arrMusic)] = $obj;
                    }


                    for ($i = 0; $i < count($arrMusic); $i++) {

                        $music = $arrMusic[$i];

                        echo "</tr><td>" . $music->name . "</td>" .
                            "<td > " . $music->size . " </td >" .
                            "<td>" . $music->length . "</td>" .
                            "<td>" . $music->author . "</td>" .
                            "<td>" . $music->classfyId . "</td>" .
                            " <td><a href=\"#\" data-id='" . $music->id . "' class='editMusicInfo'>编辑</a></td>" .
                            "<td><a href=\"#\" data-id='" . $music->id . "' class='delMusicInfo'>删除</a></td> </tr>";
                    }

                    ?>

                    <!--                        <td>简单的生活</td>-->
                    <!--                        <td>5MB</td>-->
                    <!--                        <td>4:56</td>-->
                    <!--                        <td>小芳芳的生活</td>-->
                    <!--                        <td>1</td>-->
                    <!--                        <td><a href="#">编辑</a></td>-->
                    <!--                        <td><a href="#del">删除</a></td>-->
                    </tbody>
                </table>
            </div>


            <script>

                /**
                 * 文档加载完成之后 执行
                 */
                $(document).ready(function () {

                    let id;


                    $(".editMusicInfo").click(function () {

                        id = $(this).data("id");

                        $.ajax({
                            type: "GET",
                            url: "../php/controll/RequestControll.php",
                            data: "action=manager&exe=musicDetail&id=" + id,
                            success: function (msg) {

                                $("#editMusicName").val(msg.name);
                                $("#editMusicClassfyId").val(msg.classfyId);
                                $("#editMusicBig").val(msg.size);
                                $("#editMusicLength").val(msg.length);
                                $("#editMusicAuthor").val(msg.author);

                                $("#musicEdit").modal("show");
                            }
                        })
                    })

                    /**
                     * 提交编辑
                     */
                    $("#submitEditMusic").click(function () {

                        let name = $("#editMusicName").val();
                        let classfyId = $("#editMusicClassfyId").val();
                        let size = $("#editMusicBig").val();
                        let length = $("#editMusicLength").val();
                        let author = $("#editMusicAuthor").val();

                        let params = "&name=" + name + "&size=" + size + "&length=" + length + "&author=" + author + "&classfyId=" + classfyId;

                        // alert(params);

                        $.ajax({
                            type: "GET",
                            url: "../php/controll/RequestControll.php",
                            data: "action=manager&exe=updateMusic&id=" + id + params,
                            success: function (msg) {

                                $("#musicEdit").modal("hide");

                                alert(msg.message);
                                window.location.reload();
                            }
                        })

                    })


                    $(".delMusicInfo").click(function () {

                        id = $(this).data("id");

                        $.ajax({
                            type: "GET",
                            url: "../php/controll/RequestControll.php",
                            data: "action=manager&exe=delMusic&id=" + id,
                            success: function (msg) {
                                alert(msg.message);
                                window.location.reload();
                            }
                        })


                    })


                })


            </script>


            <!--
            音乐信息管理的添加modal
            -->
            <!-- 模态框（Modal） -->


            <!---音乐类别管理-->
            <div class="two">
                <div class="title_one">
                    <h3>音乐类别管理</h3>
                    <span class="addNewClassfy" data-toggle="modal">+</span>
                </div>


                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>创建时间</th>
                        <th>操作</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $sql = "select * from classfy";

                    $result = MyDao::queryForResult($sql);

                    $classfyArr = [];

                    while ($obj = MyDao::getResultForObjects($result)) {
                        $classfyArr[count($classfyArr)] = $obj;
                    }

                    for ($i = 0; $i < count($classfyArr); $i++) {

                        $classfy = $classfyArr[$i];

                        echo "<tr> <td>" . $classfy->name . "</td>" .
                            "<td>" . $classfy->createTime . "</td>" .
                            " <td><a href=\"#\" data-id='" . $classfy->id . "' data-name='" . $classfy->name . "' class='classfyEdit'>编辑</a></td>" .
                            "<td><a href=\"#\"  data-id='" . $classfy->id . "' class='classfyDel'>删除</a></td></tr>";
                    }

                    ?>
                    <!--                    <tr>-->
                    <!--                        <td>潮流前线</td>-->
                    <!--                        <td>2019-12-12</td>-->
                    <!--                        <td><a href="#">编辑</a></td>-->
                    <!--                        <td><a href="#del">删除</a></td>-->
                    <!--                    </tr>-->
                    </tbody>
                </table>
            </div>

            <script>
                /**
                 * 分类删除和编辑的调用
                 */
                $(document).ready(function () {

                    /**
                     * 分类编辑的操作
                     * 将会把当前对应分类的music的相关信息都改为当前的分类
                     *
                     */
                    let editClassfyId;


                    $(".classfyEdit").click(function () {

                        $("#addClassfy1").text("编辑分类")

                        $("#classfyInput").val($(this).data("name"));

                        editClassfyId = $(this).data("id");

                        $("#addClassfy").modal("show");

                    })

                    $(".addNewClassfy").click(function () {

                        $("#addClassfy1").text("添加分类")

                        $("#addClassfy").modal("show");
                    })


                    $("#submitClassfy").click(function () {


                        if (editClassfyId != null) {
                            //编辑分类
                            $.ajax({

                                type: "GET",
                                url: "../php/controll/RequestControll.php",
                                data: "action=manager&exe=updateClassfy&id=" + editClassfyId + "$name=" + $("#classfyInput").val(),
                                success: function (msg) {
                                    alert(msg.message);
                                    window.location.reload();
                                }
                            })

                        } else {
                            //添加分类
                            $.ajax({

                                type: "GET",
                                url: "../php/controll/RequestControll.php",
                                data: "action=manager&exe=addClassfy&name=" + $("#classfyInput").val(),
                                success: function (msg) {
                                    alert(msg.message);
                                    window.location.reload();
                                }
                            })
                        }
                    })

                    /*8
                    删除分类
                     */
                    $(".classfyDel").click(function () {

                        let id = $(this).data("id");

                        $.ajax({

                            type: "GET",
                            url: "../php/controll/RequestControll.php",
                            data: "action=manager&exe=delClassfy&id=" + id,
                            success: function (msg) {
                                alert(msg.message);
                                window.location.reload();
                            }
                        })
                    })


                })


            </script>


            <!--媒体上传的实现-->

            <div class="three">

                <div class="title_one">
                    <h3>媒体上传</h3>
                </div>

                <div>
                    <h6>注意</h6>
                    <p>1只能上传MP3文件，请不要上传其他文件</p>
                    <p>2.请上传的文件大小不要超过10M</p>
                    <p>3.为保证上传成功，请保证在此期间不要关闭浏览器</p>
                </div>

                <div class="downBox">
                    <div class="down1">
                        <p>点击下面的按钮进行上传</p>
                        <form method="post" enctype="multipart/form-data" id="uploadForm">
                            <input type="file" name="file" id="fileInput">
                            <span class="btn btn-success download" id="upload">上传</span>
                        </form>
                    </div>
                </div>
            </div>


            <!--媒体管理的实现-->
            <div class="four">
                <div class="title_one">
                    <h3>媒体管理</h3>
                </div>

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>名字</th>
                        <th>服务器地址</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $path = getcwd();//E:\wamp\www\nyMusic\html


                    $path = str_replace("html", "music\\", $path);


                    $musicArray = scandir($path);

                    for ($i = 0; $i < count($musicArray); $i++) {

                        $item = $musicArray[$i];

//                        $item = substr($item, strrpos($item, '.') + 1);
                        if ($item == "." || $item == "..") {
                            continue;
                        }


                        echo "<tr><td>" . iconv('gbk', 'utf-8', $musicArray[$i]) . "</td>" .
                            "<td>" . iconv('gbk', 'utf-8', $path . $musicArray[$i]) . "</td>" .
                            " <td><a  href=\"#\" data-toggle=\"modal\" data-target=\"#myModal\" data-src='" . iconv('gbk', 'utf-8', $path . $musicArray[$i]) . "'>删除</a></td><tr/>";

                    }

                    ?>
                    </tbody>
                </table>
            </div>

            <div class="five">

                <div class="five_box">

                    <form>
                        <div class="form-group">
                            <label for="name">名字</label>
                            <input type="text" class="form-control" id="name" placeholder="输入名称">
                        </div>
                        <div class="form-group">
                            <label for="big">大小</label>
                            <input type="text" class="form-control" id="big" placeholder="输入音乐大小">
                        </div>

                        <div class="form-group">
                            <label for="big">长度</label>
                            <input type="text" class="form-control" id="length" placeholder="播放时长">
                        </div>

                        <div class="form-group">
                            <label for="big">作者</label>
                            <input type="text" class="form-control" id="author" placeholder="上传人/不填为当前用户">
                        </div>

                        <script>


                        </script>

                        <div>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-success">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#collapseOne" style="color: #ffffff">
                                                选择分类
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body" style="padding:0px">

                                            <table class="table table-striped table-hover">
                                                <tbody>

                                                <?php

                                                for ($i = 0; $i < count($classfyArr); $i++) {
                                                    $classfy = $classfyArr[$i];
                                                    echo "<tr class='classfyList' data-id='" . $classfy->id . "'><td><span>" . $classfy->name . "</span></td></tr>";
                                                }
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="panel-group" id="accordion1">
                                <div class="panel panel-default">
                                    <div class="panel-heading bg-success">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#collapseOne1" style="color: #ffffff">
                                                选择音乐
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne1" class="panel-collapse collapse">
                                        <div class="panel-body" style="padding:0px">

                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <?php
                                                for ($i = 0; $i < count($musicArray); $i++) {
                                                    $item = $musicArray[$i];
                                                    if ($item == "." || $item == "..") {
                                                        continue;
                                                    }
                                                    echo "<tr class='musicListItem'><td>" . iconv('gbk', 'utf-8', $musicArray[$i]) . "</td></tr>";
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="checkbox"> 使用文件默认信息
                            </label>
                        </div>

                        <span class="btn btn-default submit">Submit</span>
                    </form>

                </div>


            </div>


            <!--
            媒体管理的删除按钮的点击实现的操作modal提示一下
            -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModalLabel">
                                警告
                            </h4>
                        </div>
                        <div class="modal-body">
                            删除媒体音乐，会删除对应的音乐信息！确定继续？
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                            </button>
                            <button type="button" class="btn btn-primary" id="mediaDelTip">
                                确定
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>

            <script>
                $(document).ready(function () {

                    let deleteMediaUrl;

                    $("#mediaDelTip").click(function () {
                        $('#myModal').modal('hide');
                        $.ajax({
                            type: "GET",
                            url: "../php/controll/RequestControll.php",
                            data: "action=manager&exe=delRealMedia&url=" + deleteMediaUrl,
                            success: function (msg) {
                                alert(msg.message);
                                window.location.reload();

                            }
                        })
                    })


                    //获得删除的item的媒体的地址
                    $("a[data-target=\"#myModal\"]").click(function () {
                        deleteMediaUrl = $(this).data("src");
                        console.log(deleteMediaUrl)
                    })

                })


            </script>


            <!--
            音乐类编的管理的添加
         -->
            <div class="modal fade" id="addClassfy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="addClassfy1">
                                添加分类
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="classfyInput">输入分类</label>
                                    <input type="text" class="form-control" id="classfyInput"
                                           placeholder="输入分类">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                            </button>
                            <button type="button" class="btn btn-primary" id="submitClassfy">
                                确定
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->

            </div>
        </div>


        <!--

     编辑音乐信息
     -->

        <div class="modal fade" id="musicEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">
                            编辑音乐媒体信息
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="eidt">名称</label>
                                <input type="text" class="form-control" id="editMusicName"
                                       placeholder="输入名称">
                            </div>

                            <div class="form-group">
                                <label for="eidt">分类号</label>
                                <input type="text" class="form-control" id="editMusicClassfyId"
                                       placeholder="输入分类号">
                            </div>

                            <div class="form-group">
                                <label for="eidt">大小</label>
                                <input type="text" class="form-control" id="editMusicBig"
                                       placeholder="输入大小">
                            </div>

                            <div class="form-group">
                                <label for="eidt">长度</label>
                                <input type="text" class="form-control" id="editMusicLength"
                                       placeholder="输入长度">
                            </div>

                            <div class="form-group">
                                <label for="eidt">作者</label>
                                <input type="text" class="form-control" id="editMusicAuthor"
                                       placeholder="输入作者">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                        </button>
                        <button type="button" class="btn btn-primary" id="submitEditMusic">
                            确定
                        </button>
                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function () {


                    let account;
                    /**
                     * 获得登录的状态
                     *
                     */

                    $.ajax({
                        type: "GET",
                        url: "../php/controll/RequestControll.php",
                        data: "action=manager&exe=loginStatus",
                        success: function (msg) {
                            console.log(msg)
                            account = msg.account;
                            if (msg.account == -1) {
                                window.location.href = "./index.php";
                            }
                        }
                    })


                    let defIndex = 1;

                    let classs = [".one", ".two", ".three", ".four", ".five"]

                    function changeDis(index) {

                        // let classs = [".one", ".two", ".three", ".four", ".five"]

                        for (let i = 0; i < classs.length; i++) {

                            if (i == index) {
                                $(classs[i]).css("display", "");
                                continue;
                            }
                            $(classs[i]).css("display", "none");
                        }
                    }

                    changeDis(defIndex - 1)


                    $(".list-group-item:nth-child(" + defIndex + ")").css("background", "#0C77CF");


                    $(".left .list-group-item").hover(function () {
                        if ($(this).index() + 1 == defIndex) {
                            return
                        }
                        $(this).css("background", "#28a745")
                    })
                    $(".left .list-group-item").mouseleave(function () {
                        if ($(this).index() + 1 == defIndex) {
                            return
                        }
                        $(this).css("background", "")
                    })

                    $(".left .list-group-item").click(function () {

                        $(".list-group-item:nth-child(" + defIndex + ")").css("background", "");

                        defIndex = $(this).index() + 1;
                        $(".list-group-item:nth-child(" + defIndex + ")").css("background", "#0C77CF");

                        changeDis(defIndex - 1)

                    })


                    /**
                     * 添加新的音乐信息的点击事件的处理
                     */
                    $(".musicInfoAdd").click(function () {
                        /**
                         * 弹出模态框，添加新的音乐信息
                         */
                        $(".list-group-item:nth-child(" + defIndex + ")").css("background", "");

                        defIndex = classs.length
                        $(".list-group-item:nth-child(" + defIndex + ")").css("background", "#0C77CF");

                        changeDis(defIndex - 1)
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
                     * 文件上传的代码
                     */
                    $("#upload").click(function () {
                        var formData = new FormData($('#uploadForm')[0]);

                        let fileName = $("#fileInput")[0].value;

                        if (fileName.trim() == "") {
                            alert("请选择文件");
                            return;
                        }

                        let format = fileName.substr(fileName.lastIndexOf(".") + 1);

                        let formats = ["mp3", "wav", "ogg", "acc", "webm"];

                        var supo = false;

                        for (let i = 0; i < formats.length; i++) {
                            if (format == formats[i]) {
                                supo = true;
                                break;
                            }
                        }
                        if (!supo) {
                            alert("不支持的文件类型");
                            return;
                        }

                        $.ajax({
                            type: 'post',
                            url: "../php/controll/RequestControll.php?action=manager&exe=upload",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                        }).success(function (data) {
                            alert(data);

                            window.location.reload();

                        }).error(function () {
                            alert("上传失败");
                        });
                    })


                    let previouSelec;

                    /**
                     * 分类列表的item的点击事件的处理
                     */
                    $(".classfyList").click(function () {


                        // if ($(this).data("id") != selectClassfyId) {
                        //     //代表的是点击的不是一个
                        // }

                        if (previouSelec != null) {
                            previouSelec.css({
                                "backgroundColor": "",
                                "color": "",
                            })
                        }
                        previouSelec = $(this);

                        $(this).css({
                            "backgroundColor": "rgb(12, 119, 207)",
                            "color": "#fff",
                        });

                        selectClassfyId = $(this).data("id");
                    })

                    let previousSelecMusicItem;


                    /**
                     * 对应的音频文件的点击
                     */
                    $(".musicListItem").click(function () {

                        // console.log($(this).text());

                        if (previousSelecMusicItem != null) {
                            previousSelecMusicItem.css({
                                "backgroundColor": "",
                                "color": "",
                            });
                        }

                        previousSelecMusicItem = $(this);

                        $(this).css({
                            "backgroundColor": "rgb(12, 119, 207)",
                            "color": "#fff",
                        });

                        selectMusic = $(this).text();

                    })


                    let selectMusic;

                    let selectClassfyId;


                    function dataCheck(data, min, max) {
                        if (data == "") {
                            return false;
                        }

                        if (data.trim().length <= max && data.trim().length >= min) {
                            return true;
                        }
                        return false;
                    }


                    let insertMusicData = function () {

                        let name = $(pre + "#name")[0].value;
                        let size = $(pre + "#big")[0].value;
                        let length = $(pre + "#length")[0].value;
                        let author = $(pre + "#author")[0].value;

                        if (author.length == 0) {
                            $(pre + "#author")[0].value = "13077343";
                            author = "13074434";
                        }

                        // alert(name+size+length+author);

                        let alertDa = "";

                        alertDa = dataCheck(name, 6, 40) == true ? "" : "名字在6-40个字符之间\n";
                        alertDa += dataCheck(size, 2, 6) == true ? "" : "文件大小在2-6个字符\n";
                        alertDa += dataCheck(length, 4, 6) == true ? "" : "音乐长度在00:00-99:59\n";
                        if (alertDa.length > 1) {
                            alert(alertDa);
                            return;
                        } else {
                            //代表的是当前填写的资料是正常的数据。

                            //进行数据库的写入
                            if (selectMusic == null || selectClassfyId == null) {
                                alert("请选择音乐和音乐对应的分类信息");
                                return;
                            }

                            let params = "&name=" + name + "&size=" + size + "&length=" + length + "&author=" + author + "&classfyId=" + selectClassfyId + "&dataUrl=" + selectMusic;


                            // console.log("当前的参数" + params);
                            $.ajax({
                                type: "GET",
                                url: "../php/controll/RequestControll.php",
                                data: "action=manager&exe=insert" + params,
                                success: function (msg) {
                                    // alert(msg.msg);
                                    // console.log(msg);
                                    alert(msg.message);
                                    window.location.reload();
                                }
                            })
                        }
                    }


                    let pre = ".five .five_box ";

                    /**
                     * 提交音乐信息的点击操作
                     */
                    $(pre + ".submit").click(function () {

                        // alert($("input.checkbox").prop("checked"));

                        if ($("input.checkbox").prop("checked")) {

                            //代表的是自动获得对应的音乐的值，但是需要自己选择分类和对应的音乐
                            if (selectMusic == null || selectClassfyId == null) {

                                alert("使用文件默认信息，请选择分类和音乐");

                                return;
                            } else {
                                //进行数据的添加

                                //直接设置里面的数据

                                //通过ajax设置，传递的是音乐的名称
                                $.ajax({
                                    type: "GET",
                                    url: "../php/controll/RequestControll.php",
                                    data: "action=manager&exe=musicInfo&name=" + selectMusic,
                                    success: function (msg) {
                                        //通过服务器获得真实的数据
                                        $(pre + "#name")[0].value = msg.name;
                                        $(pre + "#big")[0].value = msg.size;
                                        $(pre + "#length")[0].value = msg.length;

                                        insertMusicData();
                                    }
                                })

                            }
                        } else {
                            //代表的是使用自己填写的数据
                            insertMusicData();
                        }

                    })


                })


            </script>


        </div>
    </div>
</body>
</html>