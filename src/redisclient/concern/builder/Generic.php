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
 * 通用操作
 */
trait Generic
{
    /**
     * ping 服务器
     * @access public
     * @param bool $master 是否主服务器
     * @param string $value 要返回的字符串
     * @return string|bool
     */
    public function ping($master = false, $value = null)
    {
        return $this->connection->ping($master, $value);
    }

    /**
     * 复制键的值到另外一个键
     * @access public
     * @param string $target 目标键名
     * @param array $options 操作参数
     * @return bool
     */
    public function copy($target, array $options = [])
    {
        return $this->connection->copy($this->key, $target, $options);
    }

    /**
     * 删除一个或多个键
     * @access public
     * @return bool
     */
    public function del()
    {
        return $this->connection->del($this->key);
    }
    
    /**
     * 将指定的 key 做序列化处理,并返回被序列化的值
     * @access public
     * @return string
     */
    public function dump()
    {
        return $this->connection->dump($this->key);
    }

    /**
     * 检查给定key是否存在
     * @access public
     * @return int|bool
     */
    public function exists()
    {
        return $this->connection->exists($this->key);
    }

    /**
     * 设置过期时间（以秒为单位）
     * @access public
     * @param int $timeout
     * @return bool
     */
    public function expire($timeout)
    {
        return $this->connection->expire($this->key, $timeout);
    }

    /**
     * 设置过期时间（到指定的Unix时间戳过期）
     * @access public
     * @param int $timestamp
     * @param string $mode
     * @return bool
     */
    public function expireAt($timestamp, $mode = null)
    {
        return $this->connection->expireAt($this->key, $timeout, $mode);
    }

    /**
     * 过期时间的Unix时间戳
     * @access public
     * @param string $key
     * @return int|false
     */
    public function expiretime()
    {
        return $this->connection->expiretime($this->key);
    }

    /**
     * 获取匹配的所有键名
     * @access public
     * @return array|false
     */
    public function keys()
    {
        return $this->connection->keys($this->key);
    }

    /**
     * 以原子方式将键从传输到另一个服务器
     * @access public
     * @param string $connection 目标服务器连接标识
     * @param int $timeout 指定超时时间（单位毫秒）
     * @param bool $copy 是否保留原服务器数据
     * @param bool $replace 对于已存在的键是否覆盖
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function migrate($connection, $timeout = 5000, $copy = false, $replace = false)
    {
        return $this->connection->migrate($this->key, $connection, $timeout, $copy, $replace);
    }

    /**
     * 将指定的键移动到当前服务器的另一个数据库中
     * @access public
     * @param int $index
     * @return bool
     */
    public function move($index)
    {
        return $this->connection->move($this->key, $index);
    }

    /**
     * object命令
     * @access public
     * @param string $subcommand 子命令
     * @return int|string|false
     */
    public function object($subcommand)
    {
        return $this->connection->object($subcommand, $this->key);
    }

    /**
     * 移除键的过期时间
     * @access public
     * @return bool
     */
    public function persist()
    {
        return $this->connection->persist($this->key);
    }

    /**
     * 设置过期时间（以毫秒为单位）
     * @access public
     * @param int $timeout
     * @param string $mode
     * @return bool
     */
    public function pexpire($timeout, $mode = null)
    {
        return $this->connection->pexpire($this->key, $timeout, $mode);
    }

    /**
     * 设置过期时间（到指定的Unix时间戳毫秒过期）
     * @access public
     * @param int $timeout
     * @param string $mode
     * @return bool
     */
    public function pexpireAt($timeout, $mode = null)
    {
        return $this->connection->pexpireAt($this->key, $timeout, $mode);
    }

    /**
     * 过期时间的Unix时间戳（以毫秒为单位）
     * @access public
     * @return int|false
     */
    public function pexpiretime()
    {
        return $this->connection->pexpiretime($this->key);
    }

    /**
     * 获取键的剩余到期时间（以毫秒为单位）
     * @access public
     * @return int|false
     */
    public function pttl()
    {
        return $this->connection->pttl($this->key);
    }

    /**
     * 从当前库随机返回一个键
     * @access public
     * @return string|false
     */
    public function randomKey()
    {
        return $this->connection->randomKey();
    }

    /**
     * 重命名键名
     * @access public
     * @param string $newKeyName
     * @return bool
     */
    public function rename($newKeyName)
    {
        return $this->connection->rename($this->key, $newKeyName);
    }

    /**
     * 重命名键名,仅当新键名不存在时
     * @access public
     * @param string $newKeyName
     * @return bool
     */
    public function renameNx($newKeyName)
    {
        return $this->connection->renameNx($this->key, $newKeyName);
    }

    /**
     * 通过DUMP命令生成的二进制值恢复键
     * @access public
     * @param int $ttl 过期时间
     * @param string $value 字符串的二进制值
     * @param array|null $options
     * @return bool
     */
    public function restore($ttl, $value, $options = null)
    {
        return $this->connection->restore($this->key, $ttl, $value, $options);
    }

    /**
     * 通过迭代器扫描键
     * @access public
     * @param int|null $iterator Redis每次调用SCAN后返回的指针,在调用的初始调用中,调用方应该将其初始化为NULL,每次调用SCAN时,迭代器都会更新为一个新的数字,直到最后Redis将该值设置为零,表明扫描完成
     * @param string|null $pattern 用于匹配键名的glob规则,如果传NULL则相当于'*'
     * @param int $count 每次迭代返回的键数量
     * @param string $type 指定要扫描的键类型（例如STRING,LIST,SET）
     * @return array|false
     */
    public function scan($iterator, $pattern = null, $count = 0, $type = null)
    {
        return $this->connection->scan($iterator, $pattern = null, $count = 0, $type = null);
    }

    /**
     * 对LIST,SET或SORTSET内的元素进行排序
     * @access public
     * @param array|null $options
     * @return mixed
     */
    public function sort($options = null)
    {
        return $this->connection->sort($this->key, $options);
    }

    /**
     * 返回LIST,SET或SORTSET排序后的元素, 不改变原来的排序
     * @access public
     * @param array|null $options
     * @return mixed
     */
    public function sort_ro($options = null)
    {
        return $this->connection->sort_ro($this->key, $options);
    }

    /**
     * 返回指定键中最后访问过的键的数量,如果不存在则会忽略
     * @access public
     * @return int|false
     */
    public function touch()
    {
        return $this->connection->touch($this->key);
    }

    /**
     * 获取键的剩余到期时间（以秒为单位）
     * @access public
     * @return int|false
     */
    public function ttl()
    {
        return $this->connection->ttl($this->key);
    }
    
	/**
	 * 返回key所储存的值的类型。
	 * none(key不存在) int(0)
	 * string(字符串) int(1)
	 * set(集合) int(2)
	 * list(列表) int(3)
	 * zset(有序集) int(4)
	 * hash(哈希表) int(5)
     * @access public
     * @return int|false
	 */
	public function type() {
		return $this->connection->type($this->key);
	}

    /**
     * 删除一个或多个键, 此操作是异步的, 不会阻塞
     * @access public
     * @return int|false
     */
    public function unlink()
    {
        return $this->connection->unlink($this->key);
    }

    /**
     * 阻塞当前客户端，直到所有先前的写入命令成功传输，并且由至少指定数量的副本（slave）确认
     * 在达到指定数量的副本或超时时，该命令将始终返回确认在 WAIT 命令之前发送的写入命令的副本数量
     * @access public
     * @param int $numreplicas 要确认写入操作的副本数量
     * @param int $timeout 等待时间（0表示不限制）
     * @return int|false
     */
    public function wait($numreplicas, $timeout)
    {
        return $this->connection->wait($numreplicas, $timeout);
    }

    /**
     * 返回当前数据库中键的数量
     * @access public
     * @param bool $master 是否主服务器
     * @return int|false
     */
    public function dbSize($master = false)
    {
        return $this->connection->dbSize($master);
    }

    /**
     * 清空所有库中的数据
     * @access public
     * @param string $password 密码
     * @param bool|null $sync 是以阻塞还是非阻塞的方式执行任务
     * @return bool
     */
    public function flushAll($password = '', $sync = null)
    {
        return $this->connection->flushAll($password, $sync = null);
    }

    /**
     * 清空当前库中的数据
     * @access public
     * @param string $password 密码
     * @param bool|null $sync 是以阻塞还是非阻塞的方式执行任务
     * @return bool
     */
    public function flushDB($password = '', $sync = null)
    {
        return $this->connection->flushDB($password, $sync = null);
    }

    /**
     * 持久化
     * @access public
     * @param bool $master 是否主服务器
     * @return bool
     */
    public function bgSave($master = false)
    {
        return $this->connection->bgSave($master);
    }

    /**
     * 返回服务器当前时间
     * @access public
     * @return array
     */
    public function time()
    {
        return $this->connection->time();
    }
}
