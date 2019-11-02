<?php


class  DaoHelper
{
    const DB = "db1";
    const USER = "root";
    const PASSWORD = "123";
    const HOST = "localhost";
    const PORT = "3306";

    private static $con;


    public static function getOpen()
    {
        //建立数据哭连接
        self::$con = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::DB, self::PORT);

        return self::$con;
    }


    private static function closeConn()
    {
        mysqli_close(self::$con);
    }

    public static function query($sql, $callFunc)
    {

        if ($result = mysqli_query(self::$con, $sql)) {//查询是否有结果

            while ($obj = mysqli_fetch_object($result)) {
                array_map($callFunc, $obj);
            }
            mysqli_free_result($result);
        }
        self::closeConn();
    }


    public static function delete($sql)
    {
        $result = mysqli_query(self::$con, $sql);
        mysqli_free_result($result);
        self::closeConn();
    }

    public static function insert($sql)
    {
        self::delete($sql);
    }

    public static function update($sql)
    {
        self::delete($sql);
    }


}


?>