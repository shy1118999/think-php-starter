<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 16:25:14
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 16:47:58
 * @Description: User Model
 */

namespace app\api\model;

use app\base\BaseModel;

class UserModel extends BaseModel
{
    protected $table = 'user';
    protected $hidden = ['pwd', 'delete_time'];
    public function roles()
    {
        return $this->hasMany(UserRoleModel::class, 'user_id', 'id')->field(['id', 'role_id', 'relation_id', 'user_id']);
    }
}
