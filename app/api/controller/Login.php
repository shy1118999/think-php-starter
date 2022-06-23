<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 16:34:01
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:09:52
 * @Description: Login Controller
 */

namespace app\api\controller;

use app\api\model\UserModel;
use app\api\service\TokenService;
use app\api\validate\LoginValidate;
use app\base\BaseController;

class Login extends BaseController
{
    public function test()
    {
        $user = UserModel::with(['roles'])->find(1);
        return output(['user' => $user, 'pwd' => $user->pwd, 'xx' => encode_password('123456')]);
    }

    public function login()
    {
        // 验证参数
        $validate = new LoginValidate();
        if (!$validate->check($this->request->param())) {
            return output(422, $validate->getError());
        }
        $data = $validate->getDataByRule($this->request->post());
        // 查询用户
        $user = UserModel::where('tel', '=', $data['username'])->find();
        if (!$user) {
            $user = UserModel::where('account', '=', $data['username'])->find();
        }
        if (!$user) {
            return output(900001);
        }
        // 验证密码
        if (!verify_password($data['password'], $user->pwd)) {
            return output(900001);
        }
        // 生成token
        return output([
            'token' => TokenService::encode($user),
        ]);
    }
}
