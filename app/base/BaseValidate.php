<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:36:18
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-08-31 18:40:31
 * @Description: Base Validate
 */

namespace app\base;

use think\Validate;
use think\facade\Request;


class BaseValidate extends Validate
{
    protected $rule = [];
    protected $message = [];
    public function __construct($rule = [], $message = [])
    {
        parent::__construct();
        $this->rule = array_merge($this->rule, $rule);
        $this->message = array_merge($this->message, $message);
    }
    /***
     * 验证方法
     */
    public function gocheck($param = [])
    {
        if (empty($param)) {
            $request = Request::instance();
            $param = $request->param();
        }

        $res = $this->batch()->check($param);

        if (!$res) {
            return false;
        } else {
            return true;
        }
    }
    /***
     * 验证是否是正整数
     */
    protected function isPositiveInt($value, $rule = '', $date = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }
    /***
     * 验证是否为空
     */
    protected function isNotEmpty($value, $rule = '', $date = '', $field = '')
    {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * 验证是不是null
     */
    protected function notnull($value, $rule = '', $date = '', $field = '')
    {
        if (is_null($value)) {
            return false;
        } else {
            return true;
        }
    }
    /***
     * 验证是否是手机号
     */
    protected function isMobile($value, $rule = '', $date = '', $field = '')
    {
        $rule = '^1(3|4|5|6|7|8|9)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /***
     * 获取数据通过验证器验证的数据
     * @return array 返回经过该验证器验证的参数的键值对
     */
    public function getDataByRule($arrays)
    {
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $arrays[$key] ?? null;
        }
        return $newArray;
    }
    /**
     * 不验证
     */
    public function notCheck($value, $rule = '', $date = '', $field = '')
    {
        return true;
    }
    /**
     * 验证数据是int型的数组
     */
    public function intArray($value, $rule = '', $date = '', $field = '')
    {
        if (!is_array($value)) {
            return false;
        }
        for ($i = 0; $i < count($value); $i++) {
            if (!(is_numeric($value[$i]) && is_int($value[$i] + 0) && ($value[$i] + 0) > 0)) {
                return false;
            }
        }
        return true;
    }
    /**
     * 验证是否是json
     */
    public function json($value, $rule = '', $data = '', $field = '')
    {
        if (is_array($value)) {
            return true;
        } else {
            json_decode($value);
            return (json_last_error() == JSON_ERROR_NONE);
        }
    }
    /**
     * 验证是否是时间戳
     */
    public function timestamp($value, $rule = '', $data = '', $field = '')
    {
        if (strtotime(date('Y-m-d H:i:s', $value)) == $value) {
            return true;
        } else {
            return false;
        }
    }
    /***
     * 验证账户是否是纯数字
     */
    public function checkAccount($value, $rule = '', $data = '', $field = '')
    {
        if (preg_match("/^\d*$/", $value)) {
            return false;
        } else {
            return true;
        }
    }
}
