<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-03 00:32:07
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:09:05
 * @Description: jwt config
 */

return [
    'key' => env('jwt.key', 'bhu78yt56fxcbnmklo098765rtgdsaqw'),
    'alg' => env('jwt.alg', 'HS256'),
    // 有效时间
    'express' => env('jwt.express', 86400),
];
