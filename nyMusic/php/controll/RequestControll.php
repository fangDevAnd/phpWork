<?php

/**
 *
 * 该php是一个前端控制器
 * 用于实现的对数据的请求转发等的实现
 * 所有的请求都会被接受到
 *
 *
 *
 *下面我们定义接口 类型
 *
 *
 * 请求参数
 *
 *
 * 1.action  代表的是请求的活动，到该界面是用来控制转发的界面
 *
 * 1. RequestInterface 里面定义了一些 action
 *
 *
 *
 */


include("./RequestInterface.php");
include("./ExeInterface.php");

include("./DetailControll/DetailControll.php");
include("./indexControll/IndexControll.php");

include("./ManagerControll/ManagerControll.php");


$action = $_GET["action"];
$exe = $_GET['exe'];


switch ($action) {

    case RequestInterface::ACTION_INDEX:


        $IndexControll = new IndexControll();
        switch ($exe) {

            /**
             * 查询当前页面的所有数据
             */
            case ExeInterface::EXE_ALL:
                $IndexControll->getAllData();
                break;

            /**
             *
             * 查询指定分类的数据
             */
            case ExeInterface::EXE_CLASSFY:

                $classfyId = $_GET['classfyId'];

                $IndexControll->getMusicForClassfy($classfyId);
                break;

            /**
             *进行登录的处理
             */
            case ExeInterface::EXE_LOGIN:

                $IndexControll->login();
                break;

            /**
             * 退出登录
             */
            case ExeInterface::EXE_EXIT_LOGIN:

                $IndexControll->exitLogin();
                break;

            /**
             *
             * 执行播放
             * 获得播放的数据
             */
            case ExeInterface::EXE_PLAY;
                $IndexControll->play();
                break;

            /**
             * 执行下载
             */
            case ExeInterface::EXE_DOWNLOAD:
                $IndexControll->download();
                break;

            case ExeInterface::EXE_REGISTER:

                $IndexControll->register();

                break;

        }

        break;


    case RequestInterface::ACTION_DETAIL:


        break;


    case RequestInterface::ACTION_MANAGER:

        $managerControll = new ManagerControll();

        switch ($exe) {
            case ExeInterface::EXE_LOGIN_STATUS:

                $managerControll->loginStatus();

                break;

            case ExeInterface::EXE_UPLOAD:

                $managerControll->upload();

                break;

            case ExeInterface::EXE_INSERT:

                $managerControll->insert();
                break;

            case ExeInterface::EXE_MUSIC_INFO:

                $managerControll->getMusicInfo();

                break;

            case ExeInterface::EXE_DEL_REAL_MEDIA:

                $managerControll->delRealMedia();

                break;

            case ExeInterface::EXE_UPDATE_CLASSFY:

                $managerControll->updateClassfy();

                break;

            case ExeInterface::EXE_ADD_CLASSFY:

                $managerControll->addClassfy();

                break;

            case ExeInterface::EXE_DEL_CLASSFY:

                $managerControll->delClassfy();


                break;
            case ExeInterface::EXE_MUSIC_DETAIL:

                $managerControll->getMusicDetail();

                break;

            case ExeInterface::EXE_UPDATE_MUSIC:

                $managerControll->updateMusic();
                break;

            case ExeInterface::EXE_DEL_MUSIC:

                $managerControll->delMusic();

                break;
        }
        break;
}


?>