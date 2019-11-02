<?php


class MyDao
{


    /**
     * 数据库名称
     */
    const  DB_NAME = "nyMusic";

    const USER = "root";

    const PASSWORD = "";

    const HOST = "localhost";


    /**
     * @return false|mysqli获得数据库的连接
     */
    public static function getConnection()
    {

        $conn = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::DB_NAME);

        mysqli_query($conn, "SET NAMES 'UTF8'");
        mysqli_query($conn, "SET CHARACTER SET UTF8");
        mysqli_query($conn, "SET CHARACTER_SET_RESULTS=UTF8'");

        if (!$conn) {
            throw new \mysql_xdevapi\Exception("数据库连接出现问题");
        }

        return $conn;
    }


    /**
     * @param $query
     *
     * 查询输入的sql语句
     * 返回的是查询的结果集合
     */
    public static function queryForResult($query)
    {

        $result = mysqli_query(self::getConnection(), $query);

        if (!$result) {
            printf("Error: %s\n%s", mysqli_error(self::getConnection()), $query);
            exit();
        }


        return $result;
    }


    /**
     * 获得查询结果的对象显示的方式
     */
    public static function getResultForObjects($result)
    {
        $obj = mysqli_fetch_object($result);
        return $obj;
    }


    public static function getResultForArray($result)
    {
        $obj = mysqli_fetch_array($result);
        return $obj;
    }


    /**
     * 关闭数据库的连接
     */
    public static function close()
    {
        $connec = self::getConnection();
        if ($connec) {
            mysqli_close($connec);
        }
    }


}


?>
