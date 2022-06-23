<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:49:59
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 15:55:55
 * @Description: Demo Controller
 */

namespace app\api\controller;

use app\base\BaseController;

class Demo extends BaseController
{
    public function index()
    {
        return output(['hello' => 'world']);
    }
}
