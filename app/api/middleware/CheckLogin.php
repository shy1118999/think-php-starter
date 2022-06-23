<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 17:16:38
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:18:21
 * @Description: Check Login Middleware
 */

namespace app\api\middleware;

use app\api\model\UserModel;
use app\api\service\TokenService;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
        $token = $request->header('token');
        $u_id = TokenService::decode($token);
        if (!$u_id) {
            return output(900002);
        }
        $user = UserModel::with(['roles'])->find($u_id);
        if (!$user) {
            return output(900003);
        }
        $request->user_info = $user;
        return $next($request);
    }
}
