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

namespace think\redisclient\concern\builder;

/**
 * HyperLogLog操作
 */
trait HyperLogLog
{
    /**
     * 添加一个或多个元素
     * @access public
     * @param array $elements 一个或多个元素
     * @return int
     */
    public function pfadd($elements)
    {
        return $this->connection->pfadd($this->key, $elements);
    }

    /**
     * 获取HyperLogLog存储的基数
     * @access public
     * @return int
     */
    public function pfcount()
    {
        return $this->connection->pfcount($this->key);
    }

    /**
     * 合并多个HyperLogLog到新的集合
     * @access public
     * @param array $srckeys 要合并的集合键名
     * @return bool
     */
    public function pfmerge(array $srckeys)
    {
        return $this->connection->pfmerge($this->key, $srckeys);
    }
}
