<?php

namespace Art\Core;

class Route
{
    // 어느 url로 오면 어느 콘트롤러가 실행되라
    private static $GET = [];
    private static $POST = [];

    public static function init()
    {
        // /board/list?p=1&cat=life
        // /
        $path = explode("?", $_SERVER['REQUEST_URI']);   //split
        $path = $path[0];

        $method = $_SERVER['REQUEST_METHOD'];

        foreach( self::${$method} as $uri => $arg ) {
            if($uri == $path) {
                $data = explode("@", $arg);
                $controllerName = "Art\\Controller\\". $data[0];
                
                $controller = new $controllerName(); //다른 언어에서는 Reflection
                $controller->{$data[1]}();
                return;
            }
        }
        //여기까지 와버렸다는 건 라우터에 없는 애를 찾은거 
        echo "404 Not Found <a href='/'>홈으로 돌아가기</a>";
        //actions에서 $path 를 찾아서. 그거랑 연결된 애를 실행하는거
    }

    public static function GET($url, $args)
    {
        self::$GET[$url] = $args;
    }

    public static function POST($url, $args)
    {
        self::$POST[$url] = $args;
    }
}