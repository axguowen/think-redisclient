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
 * 事务操作
 */
trait Transactions
{
    /**
     * 放弃当前正在进行的事务
     * @access public
     * @return bool
     */
    public function discard()
    {
        return $this->connection->discard();
    }

    /**
     * 执行事务命令
     * @access public
     * @return array|false
     */
    public function exec()
    {
        return $this->connection->exec();
    }

    /**
	 * 开始事务
     * @access public
	 * @param int $value 事务类型，Redis::MULTI 或 Redis::PIPELINE
     * @return bool
	 */
	public function multi($value = \Redis::MULTI)
    {
		return $this->connection->multi($value);
	}

    /**
	 * 取消事务监听
     * @access public
     * @return bool
	 */
	public function unwatch()
    {
		return $this->connection->unwatch();
	}

    /**
	 * 事务监听
     * @access public
	 * @param array|string $key
	 * @param string $other_keys
     * @return bool
	 */
	public function watch($key, ...$other_keys)
    {
		return $this->connection->watch($key, ...$other_keys);
	}
}
