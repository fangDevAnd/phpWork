<?php


//写入数据库

$con = DaoHelper::getOpen();


header('Content-Type:application/json; charset=utf-8');


$arr = array('code' => 1, 'message' => "注册成功");


exit(json_encode($arr));

?>