<?php

use Art\Core\Route;

Route::GET("/", "MainController@index");
Route::GET("/search", "MainController@index");


Route::GET("/join", "JoinController@joinPage");
Route::POST("/join", "JoinController@joinProcess");
Route::POST("/login", "JoinController@loginProcess");
Route::GET("/detail", "DetailController@detailPage");
Route::GET("/page", "MainController@index");
Route::GET("/check", "JoinController@checkProcess");

if(user()){
    Route::POST("/detail", "DetailController@detailComment");
    Route::GET("/commentDel", "DetailController@commentDel");
    Route::GET("/logout", "JoinController@logoutProcess");
    Route::GET("/upload", "UploadController@uploadPage");
    Route::POST("/upload", "UploadController@uploadProcess");
    Route::GET("/my-page", "MypageController@myPage");
    Route::POST("/my-page", "MypageController@myPageProcess");
    Route::GET("/modify", "ModifyController@modifyPage");
    Route::POST("/modify", "ModifyController@modifyProcess");
    Route::GET("/my-list", "MylistController@mylistPage");
    Route::POST("/my-list", "MylistController@mylistProcess");
    Route::GET("/delete", "ModifyController@deleteProcess");
    if(user()->uid == "admin") {
        Route::GET("/admin", "AdminController@adminPage");
        Route::POST("/admin", "AdminController@userModify");
        Route::GET("/userDel", "AdminController@userDel");
    }
}