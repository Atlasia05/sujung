<?php
namespace Art\Core;

class Lib
{
    public static $categories = ["life", "art", "fashion", "technics", "etcs"];
    public static function MsgAndBack($msg)
    {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "history.back()";
        echo "</script>";
    }

    public static function MsgAndGo($msg, $href)
    {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "location.href='{$href}'";
        echo "</script>";
    }
}