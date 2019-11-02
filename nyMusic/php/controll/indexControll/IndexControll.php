<?php


/**
 * Class IndexControll
 *
 * 首页的控制类，实现的是对业务逻辑的抽离
 */


/**
 * 导入实体类
 */

require("../entity/Entity.php");
require("../daoService/MusicDaoService.php");
require("../daoService/ClassfyDaoService.php");
require("../daoService/UserDaoService.php");

require("../util/Util.php");


/**
 * 账户
 */
const ACCOUNT = "account";

/**
 * 登录的密码
 */
const PASSWORD = "password";

/**
 * 已经注册
 */
const REGISTED = -2;


const MUSIC_ROOT = "http://localhost/nyMusic/music";


class IndexControll
{


    private $musicDao;

    private $userDao;

    private $classfyDao;


    public function __construct()
    {
        $this->classfyDao = new ClassfyDaoService();
        $this->musicDao = new MusicDaoService();
        $this->userDao = new UserDaoService();
    }


    /**
     * 代表的是返回index的所有数据
     * 调用数据库返回需要返回的数据
     *
     * 首页的数据包括
     * 1.所有的音乐信息
     * 2.用户登录信息
     * 3.分类信息
     *
     *
     */
    public function getAllData()
    {

        header("content-type:application/json");

        $array = $this->musicDao->getMusicOffset(MusicDaoService::DEF_INDEX, MusicDaoService::DEF_SIZE);

        $classfys = $this->classfyDao->getAllClassfy();

        $musicListCount = $this->musicDao->getMusicLength();

        $status = Util::getUserLoginStatus();

        echo "{\"arrays\":";
        echo json_encode($array);
        echo ",\"status\":";
        echo json_encode($status);
        echo ",\"classfys\":";
        echo json_encode($classfys);
        echo ",\"musicListCount\":";
        echo $musicListCount;
        echo "}";
    }

    /**
     * 进行注册
     */
    public function register()
    {
        header("content-type:application/json");

        $account = $_GET[ACCOUNT];
        $password = $_GET[PASSWORD];


        $user = new User();
        $user->account = $account;
        $user->password = $password;

        $oprate = new Oprate();

        if ($this->userDao->query($user, true)) {
            $oprate->code = Util::FAILTH;
            $oprate->message = "当前账户已经被注册";
        } else {
            $oprate = $this->userDao->addUser($user);
        }

        echo json_encode($oprate);
    }


    /**
     *
     * 登录的实现
     *
     */
    public function login()
    {

        header("content-type:application/json");

        session_start();//开启会话的维持

        $account = $_GET[ACCOUNT];
        $password = $_GET[PASSWORD];

        $user = new User();
        $user->account = $account;
        $user->password = $password;

        $oprate = new Oprate();

        if ($this->userDao->query($user, false)) {
            //存在，代表的是账户和密码是正确的

            //存储session
            $_SESSION['user'] = $account;


            $oprate->code = Util::SUCCESS;
            $oprate->message = "登录成功";

            //得到user的等级权限

            $oprate->user = $this->userDao->getUserInfo($account);


            $_SESSION['permissionLevel'] = $oprate->user->permissLevel;


//            $oprate->user = $user;

        } else {
            $oprate->code = Util::FAILTH;
            $oprate->message = "登录失败";
        }


        echo json_encode($oprate);

    }

    /**
     * 获得对应的音乐的信息
     * 传递的是一个偏移量
     */
    public function getMusic($index)
    {
        header("content-type:application/json");
        $arrays = $this->musicDao->getMusicOffset($index, MusicDaoService::DEF_SIZE);

        echo json_encode($arrays);
    }

    /**
     * @param $classfy
     * 获得指定分类的数据
     */
    public function getMusicForClassfy($classfyId)
    {
        header("content-type:application/json");

        $arrays = $this->musicDao->getMusicForClassfy($classfyId);

        echo json_encode($arrays);
    }


    /**
     * 退出登录的操作
     */
    public function exitLogin()
    {
        header("content-type:application/json");

        /**;l
         * 开启session
         *
         *
         */
        session_start();

        //删除会话变量
        unset($_SESSION['user']);

        //删除权限
        unset($_SESSION['permissionLevel']);

        $oprate = new Oprate();

        $oprate->code = 0;
        $oprate->message = "注销成功";
        echo json_encode($oprate);

    }

    /**
     * 进行播放
     */
    public function play()
    {
        header("content-type:application/json");

        $id = $_GET['id'];

        $music = $this->musicDao->getMusicInfo($id);

        echo json_encode($music);
    }

    /**
     * 进行下载的操作
     */
    public function download()
    {
        $id = $_GET['id'];

        $music = $this->musicDao->getMusicInfo($id);

        $path = MUSIC_ROOT . $music->dataUrl;

        //下载收这个函数的控制，有错误
        $file_size = filesize($path);

        header("Content-type:audio/mpeg");
        header("Accept-Ranges:bytes");
        header("Accept-Length:$file_size");
        header("Content-Disposition:attachment;filename=$music->name.mp3");
        readfile($path);
        exit();

    }


}