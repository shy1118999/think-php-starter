<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:29:09
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 15:53:01
 * @Description: api route
 */
use think\facade\Route;

Route::group('demo', function () {
    Route::get('hello', 'api/demo/index');
});

Route::miss(function () {
    return output(404);
});
