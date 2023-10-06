<?php
session_start();

define("__ROOT", dirname( __DIR__ ));
const __VIEW = __ROOT . "/Views";
const __DATA = __ROOT . "/data";

require_once (__ROOT . "/functions.php");
require_once(__ROOT . "/autoload.php");
require_once(__ROOT . "/web.php");


Art\Core\Route::init(); //라우트 시작