<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:30:51
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 15:35:56
 * @Description: Base Model
 */

namespace app\base;

use think\Model;
use think\model\concern\SoftDelete;

class BaseModel extends Model
{
    // 主键
    protected $pk = 'id';
    // 启用软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    // 自动时间戳
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
}
