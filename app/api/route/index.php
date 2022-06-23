<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:29:09
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:18:39
 * @Description: api route
 */

use app\api\middleware\CheckLogin;
use think\facade\Route;

Route::group('demo', function () {
    Route::get('hello', 'api/demo/index');
});

Route::group('login', function () {
    Route::post('', 'login');
})->prefix('Login/');

Route::group('user', function () {
    Route::get('info', 'user/getInfo');
})->prefix('User/')->middleware(CheckLogin::class);

Route::miss(function () {
    return output(404);
});
