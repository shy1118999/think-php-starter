<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-02 23:58:20
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:00:59
 * @Description: login validate
 */

namespace app\api\validate;

use app\base\BaseValidate;

class LoginValidate extends BaseValidate
{
    protected $rule = [
        'username' => 'require|isNotEmpty',
        'password' => 'require|isNotEmpty',
    ];

    protected $message = [
        'username.require' => '用户名不能为空',
        'username.isNotEmpty' => '用户名不能为空',
        'password.require' => '密码不能为空',
        'password.isNotEmpty' => '密码不能为空',
    ];
}
