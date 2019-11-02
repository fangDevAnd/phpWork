<?php

/**
 *
 * 该文件中存放的是大量的尸体数据模型
 *
 */


/**
 * Class Classfy
 *
 *
 *
 */
class Classfy
{

    public $id;

    public $name;

    public $createTime;


}


/**
 *
 * 创建music的类
 *
 *
 */
class Music
{

    public $id;

    public $name;

    public $size;

    public $length;

    public $author;

    public $classfyId;

    public $dataUrl;


}


class User
{

    public $nick;

    public $account;

    public $password;

    public $img;

    public $permissionLevel;


    public function __construct()
    {

    }


}


/**
 * Class Oprate
 * 操作返回的对象
 */
class Oprate
{

    public $code;

    public $message;

    /**
     * @var
     * 返回的是当前的账户
     */
    public $account;

    /*
     *返回的是当前的用户权限级别
     */

    public $permissionLevel;

    /**
     * 当前的用户
     * user
     */
    public $user;


}


?>