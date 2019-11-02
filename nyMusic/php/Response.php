<?php


class Response
{

    public static function forward($s)
    {

        echo "<script language='javascript'>";
        echo "window.location='$s'";
        echo "</script>";

    }

    public static function redirect($s)
    {
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=$s'>";
    }

    public static function update($s)
    {
        ob_start();
        header("location:$s");
        ob_end_flush();
    }


}

?>