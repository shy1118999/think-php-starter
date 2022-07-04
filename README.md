# thinkphp-starter

## 开发环境

> `php7.4`  
> `mysql5.7/mysql8`  
> `nginx`  
> `ThinkPHP6`  

## 命名规范

采用ThinkPHP6.0明明规范[链接🔗](https://static.kancloud.cn/manual/thinkphp6_0/1037482)  
***请理解并尽量遵循以下命名规范，可以减少在开发过程中出现不必要的错误。***  
### 目录和文件
+ 目录使用小写+下划线；
+ 类库、函数文件统一以`.php`为后缀；
+ 类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；
+ 类（包含接口和Trait）文件采用驼峰法命名（首字母大写），其它文件采用小写+下划线命名；
+ 类名（包括接口和Trait）和文件名保持一致，统一采用驼峰法命名（首字母大写）；
### 函数和类、属性命名
+ 类的命名采用驼峰法（首字母大写），例如 `User`、`UserType`；
+ 函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 `get_client_ip`；
+ 方法的命名使用驼峰法（首字母小写），例如 `getUserName`；
+ 属性的命名使用驼峰法（首字母小写），例如 `tableName`、`instance`；
+ 特例：以双下划线__打头的函数或方法作为魔术方法，例如 `__call` 和 `__autoload`；
### 常量和配置
+ 常量以大写字母和下划线命名，例如 `APP_PATH`；
+ 配置参数以小写字母和下划线命名，例如 `url_route_on` 和`url_convert`；
+ 环境变量定义使用大写字母和下划线命名，例如`APP_DEBUG`；
### 数据表和字段
+数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如 `think_user` 表和 `user_name`字段，不建议使用驼峰和中文作为数据表及字段命名。

> 请避免使用PHP保留字（[保留字列表参见](http://php.net/manual/zh/reserved.keywords.php) ）作为常量、类名和方法名，以及命名空间的命名，否则会造成系统错误。

## 注释规范

### 类注释

+ 控制器类
+ 控制器类
```php 
/***
* [作用]
* [其他]
*/
```
+ 模型类
```php
/***
 * @table:[对应表名] 
 * [其他]
 */
```
+ 验证器类
```php
/***
 * [作用]
 * @field:[验证字段名]
 * [其他]
 */
```
+ 异常类
```php
/***
 * [作用]
 * [其他]
 */
```
### 方法注释
+ API接口方法
```php
/***
 * [功能]
 * @url [路由地址]
 * @http [GET/POST/DELETE/PUT]
 * @param [参数类型] [参数名] [备注]
 * @param [参数类型] [参数名] [备注]
 * [其他]
 */
```
+ 普通方法
```php
/***
 * [功能]
 * @param [参数类型] [参数名] [备注]
 * @param [参数类型] [参数名] [备注]
 * [其他]
 */
```
### 方法内部注释
+ 需要注释代码上一行同一缩进处使用 `// 双斜线` 注释。 
### 路由注释
+ 注释路由指向的方法作用

## 自定义配置
### 新增配置项
+ 在 `/config/setting.php` 文件内自定义配置项。
### 使用配置项
+ 使用助手函数 `config()` 使用配置项。【`config("setting.配置项名称")`】

## 自定义全局方法
+ 在 `/app/common.php` 内自定义。

## 模型类基类
+ 模型类基类为`app\base\BaseModel`。
+ 模型类命名格式以`表名转大驼峰+Model.php`，如`UserModel.php`。
```php
<?php

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
```
+ 模型公共方法请写在此基类。
+ 例如：新建一个用户模型类：UserModel.php
```php
<?php
namespace app\api\model;

use app\base\BaseModel;
/***
 * @table: user 
 * [用户管理模型]
 */
class UserModel extends BaseModel
{
    protected $table = 'user';
}
```

## 控制器基类
+ 控制器基类为`app\base\BaseControl`。

## 数据返回
+ 数据返回调用助手函数`output()`。
+ 成功`output`方法直接传入数组。
+ 失败/错误`output`方法第一个参数返回错误码，第二个参数可以添加返回数据(`array`)。
+ 错误码在`config/message.php`文件中定义。

## 验证器类
+ 验证器基类`app\base\BaseValidate`。
+ 规定：所有的自定义验证方法全部放在基类验证器中。
+ 子类验证器必须继承这一验证器。
+ 子类继承时，请重写 `$rule,$message` 属性。
+ `protected $rule` 为验证规则。
+ `protected $message` 为该字段验证不通过返回的消息。
+ 使用该验证器直接 `new` 验证器对象并调用 `gocheck()` 方法即可.[`(new 验证器类名())->gocheck();`]

例如：自定义ID必须为正整数验证器：
```php
<?php
namespace app\api\validate;
use app\base\BaseValidate;
/***
 * [验证器子类：ID必须为正整数]
 */
class IDMustBePositiveInt extends BaseValidate{
    protected $rule = [
        "id"=>"require|isPositiveInt",
    ];
    protected $message = [
        "id"=>"id必须是正整数"
    ];
}
```
使用该验证器：
```php
// 使用前 请引入该验证器的命名空间
(new IDMustBePositiveInt())->gocheck();
```

## 路由

+ 采用定义路由模式。
+ 采用强制路由模式【已设置】。
+ 采用 `get\post\delete\put` 四类。
+ 获取数据采用 `get` ;新增数据采用 `post` ;删除数据采用 `delete` ;更新数据采用 `put` 。
+ 可以使用路由分组的 请使用路由分组。【TP框架文档说使用路由分组效率高】
+ `route.php` 内部有一个例子。