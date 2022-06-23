<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 17:13:50
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:44:25
 * @Description: User Controller
 */

namespace app\api\controller;

use app\base\BaseController;

class User extends BaseController
{
    public function getInfo()
    {
        $info = $this->request->user_info;
        return output(['info' => $info]);
    }
}
