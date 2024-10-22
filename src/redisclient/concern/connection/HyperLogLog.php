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

namespace think\redisclient\concern\connection;

/**
 * HyperLogLog操作
 */
trait HyperLogLog
{
    /**
     * 添加一个或多个元素
     * @access public
     * @param string $key
     * @param array $elements 一个或多个元素
     * @return int
     */
    public function pfadd($key, $elements)
    {
        return $this->getConnection(true)->pfadd($key, $elements);
    }

    /**
     * 获取HyperLogLog存储的基数
     * @access public
     * @param string $key
     * @return int
     */
    public function pfcount($key)
    {
        return $this->getConnection()->pfcount($key);
    }

    /**
     * 合并多个HyperLogLog到新的集合
     * @access public
     * @param string $key 新的键名
     * @param array $srckeys 要合并的集合键名
     * @return bool
     */
    public function pfmerge($key, array $srckeys)
    {
        return $this->getConnection(true)->pfmerge($key, $srckeys);
    }
}
