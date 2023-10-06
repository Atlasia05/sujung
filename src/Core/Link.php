<?php

namespace Art\Core;

class Link 
{
    public static function CSS($path) {
        switch($path) {
            case "join" :
                return '<link rel="stylesheet" href="css/join.css">';
            case "my-page" :
                return '<link rel="stylesheet" href="css/my-page.css">';
            case "upload" :
                return '<link rel="stylesheet" href="css/Upload.css">';
            case "detail" :
                return '<link rel="stylesheet" href="css/detail.css">';
            case "modify" :
                return '<link rel="stylesheet" href="css/Upload.css">';
            case "my-list" :
                return '<link rel="stylesheet" href="css/my-list.css">';
            case "admin" :
                return '<link rel="stylesheet" href="css/admin.css">';
            default :
                return '<link rel="stylesheet" href="css/index.css">';
        };
    }

    public static function JS($path) {
        switch($path) {
            case "join" :
                return '<script src="js/join.js"></script>';
            case "my-page" :
                return '<script src="js/my-page.js"></script>';
            case "upload" :
                return '<script src="js/Upload.js"></script>';
            case "detail" :
                return '<script src="js/detail.js"></script>';
            case "modify" :
                return '<script src="js/modify.js"></script>';
            case "my-list" :
                return '<script src="js/main.js"></script>';
            case "admin" :
                return '<script src="js/admin.js"></script>';
            default :
                return '<script src="js/main.js"></script>';
        };
    }
}