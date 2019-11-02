<?php


/**
 * Class ClassfyDaoService
 * 分类信息的数据的调用
 */
class ClassfyDaoService
{

    public function getAllClassfy()
    {

        $sql = "select * from classfy";

        $result = MyDao::queryForResult($sql);

        $arr = [];

        while ($obj = MyDao::getResultForObjects($result)) {
            $arr[count($arr)] = $obj;
        }

        return $arr;
    }


    /**
     * @param $classfy
     * 添加一个分类
     */
    public function addClassfy($classfy)
    {

        $sql = "insert into classfy(createTime,name) values('" . $classfy->createTime . "','" . $classfy->name . "')";

        $oprate = new Oprate();

        $result = MyDao::queryForResult($sql);
        if ($result) {
            $oprate->code = Util::SUCCESS;
            $oprate->message = "添加成功";
        } else {
            $oprate->code = Util::FAILTH;
            $oprate->message = "添加失败";
        }
        return $oprate;

    }

    /**
     * @param Classfy $classfy
     * 更新分类
     */
    public function updateClassfy(Classfy $classfy)
    {
        $sql = "update classfy set name='" . $classfy->name . "' where id=" . $classfy->id;

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
     * @param $id
     * 删除分类
     */
    public function delClassfy($id)
    {

        $sql = "delete from classfy where id=" . $id;

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


}