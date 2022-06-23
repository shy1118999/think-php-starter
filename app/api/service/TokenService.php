<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-03 00:25:31
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:07:03
 * @Description: token service
 */

namespace app\api\service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use app\api\model\UserModel;

class TokenService
{
    public static function getKey(int $id)
    {
        // 将id转换为50进制
    }
    public static function encode(UserModel $user)
    {
        // jwt
        $time = time();
        $data = [
            "exp" => $time + config('jwt.express'),
            "id" => dec_to($user->id),
        ];
        return JWT::encode($data, config('jwt.key'), config('jwt.alg'));
    }

    public static function decode($token)
    {
        if (!$token) {
            return 0;
        }
        // jwt
        try {
            $data = JWT::decode($token, new Key(config('jwt.key'), config('jwt.alg')));
            return dec_from($data->id);
        } catch (\Exception $e) {
            return 0;
        }
    }
}
