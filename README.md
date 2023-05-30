# ThinkPHP Redis 客户端管理器

一个简单的 ThinkPHP Redis 客户端连接管理工具


## 安装
~~~
composer require axguowen/think-redisclient
~~~

## 使用

首先配置config目录下的redisclient.php配置文件，然后可以按照下面的用法使用。

### 简单使用
~~~php
use \think\facade\RedisClient;
// 默认本机
$ping = RedisClient::ping();
// 连接其它服务器
$clientOther = RedisClient::connect('other');
// ping
$pingOther = $clientOther->ping();

// set方法
$setKey = RedisClient::set('mykey', 'myvalue');
// 连接其它服务器
$setKeyOther = RedisClient::connect('other')->set('mykey', 'myvalue');
~~~

### 使用键名构造器
~~~php
use \think\facade\RedisClient;

$mykey = RedisClient::key('mykey');

// 设置值
$mykey->set('myvalue');
$value = $mykey->get();
var_dump($value);

// 将当前值改成其它值
$mykey->set('othervalue');
$value = $mykey->get();
var_dump($value);
~~~