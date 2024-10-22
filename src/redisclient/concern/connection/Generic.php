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
        return $this->getConnection($master)->ping($value);
    }

    /**
     * 复制键的值到另外一个键
     * @access public
     * @param string $key 指定的键名
     * @param string $target 目标键名
     * @param array $options 操作参数
     * @return bool
     */
    public function copy($key, $target, array $options = [])
    {
        return $this->getConnection(true)->copy($key, $target, $options);
    }

    /**
     * 删除一个或多个键
     * @access public
     * @param string|array $key 要删除的键
     * @return bool
     */
    public function del($key)
    {
        return $this->getConnection(true)->del($key);
    }

    /**
     * 将指定的 key 做序列化处理,并返回被序列化的值
     * @access public
     * @param string $key
     * @return string
     */
    public function dump($key)
    {
        return $this->getConnection()->dump($key);
    }

    /**
     * 检查给定key是否存在
     * @access public
     * @param string|array $key
     * @return int|bool
     */
    public function exists($key)
    {
        return $this->getConnection()->exists($key);
    }

    /**
     * 设置过期时间（以秒为单位）
     * @access public
     * @param string $key
     * @param int $timeout
     * @return bool
     */
    public function expire($key, $timeout)
    {
        return $this->getConnection(true)->expire($key, $timeout);
    }

    /**
     * 设置过期时间（到指定的Unix时间戳过期）
     * @access public
     * @param string $key
     * @param int $timestamp
     * @param string $mode
     * @return bool
     */
    public function expireAt($key, $timestamp, $mode = null)
    {
        return $this->getConnection(true)->expireAt($key, $timeout, $mode);
    }

    /**
     * 过期时间的Unix时间戳
     * @access public
     * @param string $key
     * @return int|false
     */
    public function expiretime($key)
    {
        return $this->getConnection()->expiretime($key);
    }

    /**
     * 获取匹配的所有键名
     * @access public
     * @param string $key
     * @return array|false
     */
    public function keys($key)
    {
        return $this->getConnection()->keys($key);
    }

    /**
     * 以原子方式将键从传输到另一个服务器
     * @access public
     * @param string|array $key 要传输的键名
     * @param string $connection 目标服务器连接标识
     * @param int $timeout 指定超时时间（单位毫秒）
     * @param bool $copy 是否保留原服务器数据
     * @param bool $replace 对于已存在的键是否覆盖
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function migrate($key, $connection, $timeout = 5000, $copy = false, $replace = false)
    {
        // 获取目标服务器连接配置
        $connections = $this->client->getConfig('connections');
        if (!isset($connections[$connection])) {
            throw new \InvalidArgumentException('Undefined redisclient connections config:' . $connection);
        }
        // 获取配置
        $config = $connections[$connection];
        // 如果未指定端口则为当前连接的端口
        if(!isset($config['port'])){
            $config['port'] = $this->getConfig('port');
        }
        // 如果未指定密码则为当前连接的密码
        if(!isset($config['password'])){
            $config['password'] = $this->getConfig('password');
        }
        // 如果未指定数据库索引则为当前连接的数据库索引
        if(!isset($config['select'])){
            $config['select'] = $this->getConfig('select');
        }
        return $this->getConnection(true)->migrate($config['host'], (int) $config['port'], $key, (int) $config['select'], $timeout, $copy, $replace, $config['password']);
    }

    /**
     * 将指定的键移动到当前服务器的另一个数据库中
     * @access public
     * @param string $key
     * @param int $index
     * @return bool
     */
    public function move($key, $index)
    {
        return $this->getConnection(true)->move($key, $index);
    }

    /**
     * object命令
     * @access public
     * @param string $key
     * @param string $subcommand 子命令
     * @return int|string|false
     */
    public function object($subcommand, $key)
    {
        return $this->getConnection(true)->object($subcommand, $key);
    }

    /**
     * 移除键的过期时间
     * @access public
     * @param string $key
     * @return bool
     */
    public function persist($key)
    {
        return $this->getConnection(true)->persist($key);
    }

    /**
     * 设置过期时间（以毫秒为单位）
     * @access public
     * @param string $key
     * @param int $timeout
     * @param string $mode
     * @return bool
     */
    public function pexpire($key, $timeout, $mode = null)
    {
        return $this->getConnection(true)->pexpire($key, $timeout, $mode);
    }

    /**
     * 设置过期时间（到指定的Unix时间戳毫秒过期）
     * @access public
     * @param string $key
     * @param int $timeout
     * @param string $mode
     * @return bool
     */
    public function pexpireAt($key, $timeout, $mode = null)
    {
        return $this->getConnection(true)->pexpireAt($key, $timeout, $mode);
    }

    /**
     * 过期时间的Unix时间戳（以毫秒为单位）
     * @access public
     * @param string $key
     * @return int|false
     */
    public function pexpiretime($key)
    {
        return $this->getConnection()->pexpiretime($key);
    }

    /**
     * 获取键的剩余到期时间（以毫秒为单位）
     * @access public
     * @param string $key
     * @return int|false
     */
    public function pttl($key)
    {
        return $this->getConnection()->pttl($key);
    }

    /**
     * 从当前库随机返回一个键
     * @access public
     * @return string|false
     */
    public function randomKey()
    {
        return $this->getConnection()->randomKey();
    }

    /**
     * 重命名键名
     * @access public
     * @param string $key
     * @param string $newKeyName
     * @return bool
     */
    public function rename($key, $newKeyName)
    {
        return $this->getConnection(true)->rename($key, $newKeyName);
    }

    /**
     * 重命名键名,仅当新键名不存在时
     * @access public
     * @param string $key
     * @param string $newKeyName
     * @return bool
     */
    public function renameNx($key, $newKeyName)
    {
        return $this->getConnection(true)->renameNx($key, $newKeyName);
    }

    /**
     * 通过DUMP命令生成的二进制值恢复键
     * @access public
     * @param string $key 要创建的键名
     * @param int $ttl 过期时间
     * @param string $value 字符串的二进制值
     * @param array|null $options
     * @return bool
     */
    public function restore($key, $ttl, $value, $options = null)
    {
        return $this->getConnection(true)->restore($key, $ttl, $value, $options);
    }

    /**
     * 通过迭代器扫描键
     * @access public
     * @param int|null $iterator Redis每次调用SCAN后返回的指针,在调用的初始调用中,调用方应该将其初始化为NULL,每次调用SCAN时,迭代器都会更新为一个新的数字,直到最后Redis将该值设置为零,表明扫描完成
     * @param string|null $pattern 用于匹配关键字名称的glob规则,如果传NULL则相当于'*'
     * @param int $count 每次迭代返回的键数量
     * @param string $type 指定要扫描的键类型（例如STRING,LIST,SET）
     * @return array|false
     */
    public function scan($iterator, $pattern = null, $count = 0, $type = null)
    {
        return $this->getConnection()->scan($iterator, $pattern = null, $count = 0, $type = null);
    }

    /**
     * 对LIST,SET或SORTSET内的元素进行排序
     * @access public
     * @param string $key
     * @param array|null $options
     * @return mixed
     */
    public function sort($key, $options = null)
    {
        return $this->getConnection(true)->sort($key, $options);
    }

    /**
     * 返回LIST,SET或SORTSET排序后的元素, 不改变原来的排序
     * @access public
     * @param string $key
     * @param array|null $options
     * @return mixed
     */
    public function sort_ro($key, $options = null)
    {
        return $this->getConnection()->sort_ro($key, $options);
    }

    /**
     * 返回指定键中最后访问过的键的数量,如果不存在则会忽略
     * @access public
     * @param string|array $key
     * @return int|false
     */
    public function touch($key)
    {
        return $this->getConnection()->touch($key);
    }

    /**
     * 获取键的剩余到期时间（以秒为单位）
     * @access public
     * @param string $key
     * @return int|false
     */
    public function ttl($key)
    {
        return $this->getConnection()->ttl($key);
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
	 * @param string $key
     * @return int|false
	 */
	public function type($key) {
		return $this->getConnection()->type($key);
	}

    /**
     * 删除一个或多个键, 此操作是异步的, 不会阻塞
     * @access public
     * @param string|array $key
     * @return int|false
     */
    public function unlink($key)
    {
        return $this->getConnection(true)->unlink($key);
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
        return $this->getConnection(true)->wait($numreplicas, $timeout);
    }

    /**
     * 返回当前数据库中键的数量
     * @access public
     * @param bool $master 是否主服务器
     * @return int|false
     */
    public function dbSize($master = false)
    {
        return $this->getConnection($master)->dbSize();
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
        // 如果密码不对
        if($password !== $this->$config['password']){
            return false;
        }
        return $this->getConnection(true)->flushAll($sync);
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
        // 如果密码不对
        if($password !== $this->$config['password']){
            return false;
        }
        return $this->getConnection(true)->flushDB($sync);
    }

    /**
     * 持久化
     * @access public
     * @param bool $master 是否主服务器
     * @return bool
     */
    public function bgSave($master = false)
    {
        return $this->getConnection($master)->bgSave();
    }

    /**
     * 返回服务器当前时间
     * @access public
     * @return array
     */
    public function time()
    {
        return $this->getConnection(true)->time();
    }
}
