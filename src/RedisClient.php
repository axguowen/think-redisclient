<?php
// +----------------------------------------------------------------------
// | ThinkPHP RedisClient [Simple Redis Client For ThinkPHP]
// +----------------------------------------------------------------------
// | ThinkPHP Redis客户端
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: axguowen <axguowen@qq.com>
// +----------------------------------------------------------------------

namespace think;

use think\redisclient\Connection;

/**
 * Redis客户端
 */
class RedisClient
{
    /**
     * 连接实例
     * @var array
     */
    protected $instance = [];

    /**
     * 配置
     * @var Config
     */
    protected $config;

    /**
     * 架构方法
     * @access public
     * @param Config $config 配置对象
     * @return void
     */
    public function __construct(Config $config)
    {
        // 记录配置对象
        $this->config = $config;
    }

    /**
     * 获取配置参数
     * @access public
     * @param string $name 配置参数
     * @param mixed $default 默认值
     * @return mixed
     */
    public function getConfig($name = '', $default = null)
    {
        // 配置名不为空
        if ('' !== $name) {
            // 返回对应配置
            return $this->config->get('redisclient.' . $name, $default);
        }
        // 返回全部配置
        return $this->config->get('redisclient', []);
    }

    /**
     * 创建/切换连接
     * @access public
     * @param string|null $name 连接配置标识
     * @param bool $force 强制重新连接
     * @return Connection
     */
    public function connect($name = null, $force = false)
    {
        // 连接标识为空
        if (empty($name)) {
            // 获取默认连接标识
            $name = $this->getConfig('default', 'localhost');
        }
        // 强制重新连接或当前没有该连接实例
        if ($force || !isset($this->instance[$name])) {
            // 创建连接
            $this->instance[$name] = $this->createConnection($name);
        }
        // 返回连接实例
        return $this->instance[$name];
    }

    /**
     * 创建连接
     * @access protected
     * @param $name
     * @return Connection
     */
    protected function createConnection($name)
    {
        // 获取链接标识配置
        $connections = $this->getConfig('connections');
        // 配置不存在
        if (!isset($connections[$name])) {
            // 抛出异常
            throw new \InvalidArgumentException('Undefined redisclient connections config:' . $name);
        }
        // 返回创建的连接实例
        return new Connection($connections[$name]);
    }
    
    /**
     * 获取所有连接实列
     * @access public
     * @return array
     */
    public function getInstance()
    {
        return $this->instance;
    }

    public function __call($method, array $args)
    {
        return call_user_func_array([$this->connect(), $method], $args);
    }
}
