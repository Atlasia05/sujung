<?php
// PSR-4
function myLoader($className)
{
    $prefix = "Art\\";
    $baseDir = __ROOT . "/src/"; 
    $prefixLen = strlen($prefix); //프리픽스의 길이를 잰다.

    $realName = substr($className, $prefixLen); //앞에 Art\ 를 잘라내고 남은게 realName
    $realName = str_replace("\\", "/", $realName);
    $file = "{$baseDir}{$realName}.php";

    if(file_exists($file)){
        require_once($file);
    }
}

//찾고자하는 클래스가 없을 때 이 함수를 실행시켜보고 그다음에 다시 시도한다.
spl_autoload_register("myLoader");