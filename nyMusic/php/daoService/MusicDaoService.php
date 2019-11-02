<?php


require("../dao/daoHelper.php");


/**
 * Class MusicDaoService
 *
 * 用于实现查询音乐的数据的包装
 *
 */
class MusicDaoService
{

    /**
     * 默认查询的数据的大小
     */
    const DEF_SIZE = 20;

    const DEF_INDEX = 0;


    public function getAllMusic()
    {

        $sql = "select * from music";

        $result = MyDao::queryForResult($sql);


        $arr = array();
        while ($obj = mysqli_fetch_object($result)) {
            $arr[count($arr)] = $obj;
        }

        return $arr;
    }


    /**
     * @param $index  当前的索引
     * @param $size  每一次加载的music的大小
     * 获得音乐的数据
     */
    public function getMusicOffset($index, $size)
    {

        $sql = "select * from music limit " . ($index * $size) . "," . $size;


        $result = MyDao::queryForResult($sql);

        $arr = array();
        while ($obj = mysqli_fetch_object($result)) {
            $arr[count($arr)] = $obj;
        }

        return $arr;

    }


    /**
     * @param $id删除指定的music
     */
    public function deleteMusic($id)
    {
        $sql = "delete from music where id=" . $id;


        $oprate = new Oprate();

        $result = MyDao::queryForResult($sql);
        if ($result) {
            $oprate->code = Util::SUCCESS;
            $oprate->message = "删除成功";
        } else {
            $oprate->code = Util::FAILTH;
            $oprate->message = "删除失败";
        }
        return $oprate;
    }

    public function addMusic($music)
    {

//        $sql = "insert into music(name,size,length,author,classfy) values(%s,%s,%s,%s,%d)";
//        $sql = sprintf($sql, $music->getName(), $music->getSize(), $music->getLength(), $music->getAuthor(), $music->getClassfyId());

        $sql = "insert into music(name,size,length,author,classfyId,dataUrl) values('" . $music->name . "','"
            . $music->size . "','" . $music->length . "','" . $music->author . "'," . $music->classfyId . ",'" . $music->dataUrl . "')";

        return MyDao::queryForResult($sql);
    }


    public function updateMusic($music)
    {

//        $sql = "update music set name=%s,size=%s,length =%s,author=%s,classfy=%s where id=%d";
//        $sql = sprintf($sql, $music->getName(), $music->getSize(), $music->getLength(), $music->getAuthor(), $music->getClassfy(), $music->getId());

        $sql = "update music set name='" . $music->name . "'
        ,size='" . $music->size . "',length ='" . $music->length . "',author='"
            . $music->author . "',classfyId=" . $music->classfyId . " where id=" . $music->id;

        $oprate = new Oprate();

        $result = MyDao::queryForResult($sql);
        if ($result) {
            $oprate->code = Util::SUCCESS;
            $oprate->message = "更新成功";
        } else {
            $oprate->code = Util::FAILTH;
            $oprate->message = "更新失败";
        }
        return $oprate;
    }


    /**
     * @param $classfyName
     * 根据分类找到对应的music的信息列表
     */
    public function getMusicForClassfy($classfyId)
    {
        $sql = "select * from music where classfyId=" . $classfyId;

        $result = MyDao::queryForResult($sql);


        $arr = array();
        while ($obj = mysqli_fetch_object($result)) {
            $arr[count($arr)] = $obj;
        }
        return $arr;
    }


    /**
     * @return mixed
     * 返回的是music的长度
     */
    public function getMusicLength()
    {
        $sql = "select count(*) from music";
        $result = MyDao::queryForResult($sql);

        $row = mysqli_fetch_row($result);

        return $row[0];
    }

    /**
     * @param $id
     *
     * 获得音乐的信息
     */
    public function getMusicInfo($id)
    {
        $sql = "select * from music where id=" . $id;

        $result = MyDao::queryForResult($sql);

        $obj = mysqli_fetch_object($result);

        return $obj;
    }


}