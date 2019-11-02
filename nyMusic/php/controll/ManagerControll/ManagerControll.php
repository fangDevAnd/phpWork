<?php


require_once("../entity/Entity.php");


const FILE_NAME = "file";


/**
 * Class ManagerControll
 *
 * 后台管理的控制类
 */
class ManagerControll
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
     * 获得登录的状态
     */
    public function loginStatus()
    {
        header("content-type:application/json");

        echo json_encode(Util::getUserLoginStatus());
    }

    /**
     * 文件上传
     */
    public function upload()
    {

//        header("content-type:application/json");

        //火狐截图_2019-06-06T06-59-05.029Z.png
        //84170
        //E:\wamp\tmp\php7ACB.tmp
        //image/png
        //0
//        echo $_FILES["file"]['name'];
//        echo $_FILES["file"]['size'];
//        echo $_FILES["file"]['tmp_name'];
//        echo $_FILES["file"]['type'];
        echo $_FILES["file"]['error'];

//        echo phpinfo();


        if (!empty($_FILES[FILE_NAME]['name'])) {

            $fileInfo = $_FILES[FILE_NAME];

//            move_uploaded_file($fileInfo['tmp_name'], "../../music/" . iconv("UTF-8", "GBK", $fileInfo['name']));

            if ($fileInfo['size'] < 10000000 && $fileInfo['size'] > 0) {
                move_uploaded_file($fileInfo['tmp_name'], "../../music/" . iconv("UTF-8", "GBK", $fileInfo['name']));
                echo "上传成功";
            } else {
//                echo "上传失败,文件太大";
            }
        } else {
            echo "上传失败,未接受到文件";
        }
    }

    /**
     * 插入一条音乐信息
     */
    public function insert()
    {

//        let params = "&name=" + name + "&size=" + size + "&length=" + length + "&author=" + author + "&classfyId=" + selectClassfyId + "&dataUrl=" + selectMusic;

        header("content-type:application/json");

        /**
         *
         * 我们应该清楚的是，当前的name 不一定收拾dataUrl的名称
         */
        $name = $_GET['name'];
        $size = $_GET['size'];
        $length = $_GET['length'];
        $author = $_GET['author'];
        $classfyId = $_GET['classfyId'];
        $dataUrl = "/" . $_GET['dataUrl'];

        $music = new Music();
        $music->name = $name;
        $music->size = $size;
        $music->length = $length;
        $music->author = $author;
        $music->classfyId = $classfyId;
        $music->dataUrl = $dataUrl;

        $bool = $this->musicDao->addMusic($music);
        $oprate = new Oprate();
        if ($bool == "1") {
            $oprate->code = Util::SUCCESS;
            $oprate->message = "插入成功";
        } else {
            $oprate->code = Util::FAILTH;
            $oprate->message = "插入失败";
        }

        echo json_encode($oprate);


    }

    /**
     * 获得音乐的相关信息
     */
    public function getMusicInfo()
    {

        header("content-type:application/json");

        $name = $_GET['name'];//sfdsf.mp3

        $path = getcwd();//E:\wamp\www\nyMusic\php\controll


        $path = str_replace("php\controll", "music\\", $path);

        $filePath = $path . $name;

        //需要返回文件名称
        //文件大小
        //音乐长度
        //需要导入第三方数据包，

        $music = new Music();

        $music->name = basename($filePath);
        $music->length = "3:56";
        $music->size = "4.56MB";
        echo json_encode($music);
    }

    /**
     * 删除真实的媒体的数据
     */
    public function delRealMedia()
    {

        header("content-type:application/json");
        $url = $_GET['url'];

        unlink($url);
        $oprate = new Oprate();
        $oprate->code = Util::SUCCESS;
        $oprate->message = "插入成功";
        echo json_encode($oprate);
    }

    /**
     * 更新分类
     */
    public function updateClassfy()
    {
//     data: "action=manager&exe=updateClassfy&id=" + editClassfyId + "$name=" + $("#classfyInput").val(),
        header("content-type:application/json");
        $id = $_GET['id'];
        $name = $_GET['name'];
        $classfy = new Classfy();
        $classfy->name = $name;
        $classfy->id = $id;
        $opra = $this->classfyDao->updateClassfy($classfy);

        echo json_encode($opra);
    }

    /**
     * 添加新的分类
     */
    public function addClassfy()
    {
        header("content-type:application/json");
        // data: "action=manager&exe=addClassfy&name=" + $("#classfyInput").val(),
        $name = $_GET['name'];

        $classfy = new Classfy();
        $classfy->name = $name;
        $classfy->createTime = date("Y-m-d", time());

        $opra = $this->classfyDao->addClassfy($classfy);

        echo json_encode($opra);

    }

    /**
     * 删除分类
     */
    public function delClassfy()
    {
        header("content-type:application/json");
        $id = $_GET['id'];
        $opra = $this->classfyDao->delClassfy($id);
        echo json_encode($opra);
    }

    /**
     * 获得音乐的详细信息
     */
    public function getMusicDetail()
    {
        $id = $_GET['id'];
        header("content-type:application/json");
        $obj = $this->musicDao->getMusicInfo($id);

        echo json_encode($obj);
    }

    /**
     * 更新音乐的信息
     */
    public function updateMusic()
    {
        header("content-type:application/json");
        $name = $_GET['name'];
        $size = $_GET['size'];
        $length = $_GET['length'];
        $author = $_GET['author'];
        $classfyId = $_GET['classfyId'];
        $id = $_GET['id'];

        $music = new Music();
        $music->name = $name;
        $music->size = $size;
        $music->length = $length;
        $music->author = $author;
        $music->classfyId = $classfyId;
        $music->id = $id;

        $obj = $this->musicDao->updateMusic($music);

        echo json_encode($obj);
    }

    /**
     * 删除音乐
     */
    public function delMusic()
    {
        header("content-type:application/json");
        $id = $_GET['id'];
        $obj = $this->musicDao->deleteMusic($id);
        echo json_encode($obj);
    }


}