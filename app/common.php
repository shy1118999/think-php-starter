<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:28:04
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 15:38:56
 * @Description: common
 */

use think\Response;

/**
 * 控制器公共返回方法
 *
 * @param integer $code 状态码
 * @param array $data 数据
 * @return Response
 */
function output($code = 200, $data = array()): Response
{
    if (is_array($code)) {
        $data = $code;
        $code = 200;
    }
    return json([
        'code' => $code,
        'msg' => config('message.' . $code),
        'data' => $data
    ]);
}
