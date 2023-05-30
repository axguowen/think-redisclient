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

use axguowen\RedisClient as BaseClient;

/**
 * Redis操作客户端
 */
class RedisClient extends BaseClient
{
    /**
     * make方法
     * @param Config $config 配置对象
     * @param Log $log 日志对象
     * @return RedisClient
     * @codeCoverageIgnore
     */
    public static function __make(Config $config, Log $log)
    {
        $client = new static();
        $client->setConfig($config);
        $client->setLog($log);

        return $client;
    }

    /**
     * 设置配置对象
     * @access public
     * @param Config $config 配置对象
     * @return void
     */
    public function setConfig($config)
    {
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
        if ('' !== $name) {
            return $this->config->get('redisclient.' . $name, $default);
        }

        return $this->config->get('redisclient', []);
    }
}
