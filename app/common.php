<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:28:04
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 17:05:12
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


/**
 * 密码加密
 *
 * @param string $pwd
 * @return string 加密后的值
 */
function encode_password(string $pwd): string
{
    return password_hash($pwd, PASSWORD_DEFAULT);
}

/**
 * 验证密码是否匹配
 *
 * @param string $pwd
 * @param string $hash
 * @return boolean 是否匹配
 */
function verify_password(string $pwd, string $hash): bool
{
    return password_verify($pwd, $hash);
}


/**
 * 十进制数转换成其它进制
 * 可以转换成2-62任何进制
 *
 * @param integer $num
 * @param integer $to
 * @return string
 */
function dec_to($num, $to = 61)
{
    if ($to == 10 || $to > 61 || $to < 2) {
        return $num;
    }
    $dict = '4rstuvDEFdefghijklyWXYZ12qHIJGx89abcKLMNOP3567mnopQRSwzABCTUV';
    $ret = '';
    do {
        $ret = $dict[bcmod($num, $to)] . $ret;
        $num = bcdiv($num, $to);
    } while ($num > 0);
    return str_pad($ret, 6, '0', STR_PAD_LEFT);
}


/**
 * 其它进制数转换成十进制数
 * 适用2-62的任何进制
 *
 * @param string $num
 * @param integer $from
 * @return number
 */
function dec_from($num, $from = 61)
{
    if ($from == 10 || $from > 61 || $from < 2) {
        return $num;
    }
    // 去除前面的0
    $num = strval(ltrim($num, '0'));
    $dict = '4rstuvDEFdefghijklyWXYZ12qHIJGx89abcKLMNOP3567mnopQRSwzABCTUV';
    $len = strlen($num);
    $dec = 0;
    for ($i = 0; $i < $len; $i++) {
        $pos = strpos($dict, $num[$i]);
        $dec = bcadd(bcmul(bcpow($from, $len - $i - 1), $pos), $dec);
    }
    return $dec;
}
