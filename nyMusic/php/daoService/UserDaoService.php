<?php


/**
 * Class UserDaoService
 *
 * 管理用户的service
 */


class UserDaoService
{


    public function query($user, $or)
    {

//        $or_ = $or == true ? "or" : "and";
        $sql = "";
        if ($or) {
            $sql = "select * from user where account='" . $user->account . "' ";
        } else {
            $sql = "select * from user where account='" . $user->account . "'and password='" . $user->password . "'";
        }

//        $sql = "select * from user where account='" . $user->account . "' " . $or_ . " password='" . $user->password . "'";

//        $sql = printf($sql, $user->accound, $user->password);

        $result = MyDao::queryForResult($sql);

        $has = false;

        while ($obj = mysqli_fetch_object($result)) {
            $has = true;
        }
        return $has;
    }


    /**
     * @param $user
     * @return oprate  返回操作的结果
     *
     * 添加一个用户
     */
    public function addUser($user)
    {
        $img = empty($user->img) == true ? "null" : $user->img;
        $nick = empty($user->nick) == true ? "null" : $user->nick;
        $permissionLevel = empty($user->permissionLevel) == true ? 0 : 1;

        $sql = "insert into user(account,img,nick,password,permissLevel) values('" . $user->account . "'," . $img . "," . $nick . ",'" . $user->password . "'," . $permissionLevel . ")";


        $oprate = new Oprate();

        if (MyDao::queryForResult($sql)) {
            $oprate->code = Util::SUCCESS;
            $oprate->message = "添加成功";
        } else {
            $oprate->code = Util::FAILTH;
            $oprate->message = "添加失败";
        }
        return $oprate;
    }


    /**
     * @param $account
     * 获得用户的相关信息
     */
    public function getUserInfo($account)
    {
        $sql = "select * from user where account='" . $account . "'";
        $result = MyDao::queryForResult($sql);
        $obj = mysqli_fetch_object($result);

        return $obj;
    }


}