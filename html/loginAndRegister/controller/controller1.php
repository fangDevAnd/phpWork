<?php


class MyCall
{

    public function __construct()
    {

    }

    public function mycall($obj, $callback)
    {
        array_map($callback, $obj);
    }


    public function myCallback($obj)
    {
        echo $obj;
    }


}


$call = new MyCall();

$call->mycall("asfasfas", $call->myCallback)


?>