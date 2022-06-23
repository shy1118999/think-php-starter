<?php
/*
 * @Author: shaohang-shy
 * @Date: 2022-06-23 15:30:17
 * @LastEditors: shaohang-shy
 * @LastEditTime: 2022-06-23 15:41:03
 * @Description: Base Controller
 */

declare(strict_types=1);

namespace app\base;

use think\App;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {
    }

    /**
     * 控制器公共返回方法
     *
     * @param integer $code 状态码
     * @param array $data 数据
     * @return Response
     */
    protected function output($code = 200, $data = array())
    {
        return output($code, $data);
    }
}
