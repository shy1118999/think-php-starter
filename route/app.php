<?php
/*
 * @Author: shaohang-shy
 * @Date: 2021-12-16 21:06:37
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 15:44:43
 * @Description: app route
 */
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::miss(function () {
    return output(404);
});
