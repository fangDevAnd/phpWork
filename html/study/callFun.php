<?php


/**
 *
 * 1.变量函数 的使用
 * 上边的程序演示了一个灰回调函数的使用
 * 函数可以作为变量进行传递
 */


function call($callback)
{

    $callback("sfsdgsegewsgwe");

}

function callBack1($str)
{
    echo $str;
}

//call(callBack1)

//--------------------------------------------------
/**
 *
 * 函数中的引用传递
 * 在函数形式参数前面添加&符号
 *
 */


function test(&$var1)
{
    $var1++;

}

$var = 1;
test($var);
//echo $var;

//--------------------------------------------------------

/**
 *
 *
 *
 */


?>