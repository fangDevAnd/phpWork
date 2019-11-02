<?php


/**
 * Class Util
 *
 * 工具类
 * 实现的是对一些工具的包装
 */
class Util
{


    const ACCOUNT = "user";

    const DEF_ACCOUNT = "-1";


    /**
     * 操作失败为-1
     */
    const FAILTH = -1;

    /**
     * 操作成功
     */
    const SUCCESS = 0;


    /**
     * 获得用户的登录状态
     *
     */
    public static function getUserLoginStatus()
    {

        /**
         * 开启会话维持
         */
        session_start();
        $user = new User();

        $user->account = !empty($_SESSION[self::ACCOUNT]) ? $_SESSION[self::ACCOUNT] : self::DEF_ACCOUNT;
        
        return $user;
    }


    /**
     * 对象转换数组
     */
    public static function object_to_array($obj)
    {
        if (is_array($obj)) {
            return $obj;
        }
        $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
        foreach ($_arr as $key => $val) {
            $val = (is_array($val)) || is_object($val) ? object_to_array($val) : $val;
            $arr[$key] = $val;
        }
        return $arr;
    }

    /**
     * 把对象转化为json
     */
    public static function object_to_json($obj)
    {
        $arr2 = Util::object_to_array($obj);//先把对象转化为数组
        return json_encode($arr2);
    }


}