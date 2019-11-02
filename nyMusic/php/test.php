<?php


//require_once("daoService/ClassfyDaoService.php");
//require_once("daoService/MusicDaoService.php");
//require_once("daoService/UserDaoService.php");


/**
 * 数据库的连接测试
 */
function dbConnectTest()
{

    header("content-type:application/json");
    $conn = mysqli_connect("localhost", "root", "", "nyMusic");

    if (!$conn) {
        echo "数据库连接失败";
    }


    mysqli_query($conn, "SET NAMES 'UTF8'");
    mysqli_query($conn, "SET CHARACTER SET UTF8");
    mysqli_query($conn, "SET CHARACTER_SET_RESULTS=UTF8'");
    $result = mysqli_query($conn, "select * from music");

    if (!$result) {

        echo "查询结果出错";
    }

    $arr = array();
    while ($obj = mysqli_fetch_object($result)) {

        $arr[count($arr)] = $obj;
    }

    echo json_encode($arr);
}


function db1()
{

    $classfyDao = new ClassfyDaoService();

    $classfyDao->getAllClassfy();

}


/**
 * 函数调用的参数测试
 */
function funcCallArgusTest($index)
{

}

/**
 * 不支持无参数调用
 */
//funcCallArgusTest();

clearstatcache();

if(!filesize("E:\wamp\www\music\love.mp3")){

}


?>