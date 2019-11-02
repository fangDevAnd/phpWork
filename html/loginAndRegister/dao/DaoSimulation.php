<?php

//模拟一个数据库的数据


class  MyDao
{

    private $users;

    private static $myDao;

    public static function getInstance()
    {
        if (self::$myDao == null) {
            self::$myDao = new MyDao();
        }
        return self::$myDao;
    }


    public function __construct()
    {
        self::$users[0] = new User(121, 22, 1);
        self::$users[1] = new User(3423, 33553, 0);
        self::$users[1] = new User(3353, 424, 0);
        self::$users[1] = new User(6321, 2335, 0);
        self::$users[1] = new User(4211, 753, 0);
        self::$users[1] = new User(421, 342, 0);
    }


    public function queryExist()
    {


    }


}


?>