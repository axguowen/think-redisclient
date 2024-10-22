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
 * 字符串操作
 */
trait Strings
{
    /**
	 * 如果key已经存在并且是一个字符串，APPEND命令将value追加到key原来的值之后。
	 * 如果key不存在，APPEND就简单地将给定key设为value，就像执行SET key value一样。
     * @access public
	 * @param string $value 字符串值
     * @return int|false
	 */
	public function append($value)
    {
		return $this->connection->append($this->key, $value);
	}

    /**
	 * 将key中储存的数字值减一。
	 * 如果key不存在，以0为key的初始值，然后执行DECR操作。
	 * 如果值包含错误的类型，或字符串类型的值不能表示为数字，那么返回一个错误。
     * @access public
     * @return int|false
	 */
	public function decr()
    {
		return $this->connection->decr($this->key);
	}

    /**
	 * 将key所储存的值减去增量value。
	 * 如果key不存在，以0为key的初始值，然后执行DECRBY命令。
	 * 如果值包含错误的类型，或字符串类型的值不能表示为数字，那么返回一个错误。
     * @access public
	 * @param int $value
     * @return int|false
	 */
	public function decrBy($value)
    {
		return $this->connection->decrBy($this->key, $value);
	}

	/**
	 * 返回key所关联的字符串值。
	 * 如果key不存在则返回特殊值nil。
     * @access public
     * @return mixed
	 */
	public function get()
    {
		return $this->connection->get($this->key);
	}

    /**
	 * 获取key的值并删除该key（仅当key的值类型是字符串时）。
     * @access public
     * @return string|bool
	 */
	public function getDel()
    {
		return $this->connection->getDel($this->key);
	}

    /**
	 * 获取key的值，并设置其过期时间。
     * @access public
	 * @param array $options
     * @return string|bool
	 */
	public function getEx(array $options = [])
    {
		return $this->connection->getEx($this->key, $options);
	}

    /**
	 * 返回key中字符串值的子字符串，字符串的截取范围由start和end两个偏移量决定(包括start和end在内)。
	 * 负数偏移量表示从字符串最后开始计数，-1表示最后一个字符，-2表示倒数第二个，以此类推。
     * @access public
	 * @param int $start
	 * @param int $end
     * @return string|false
	 */
	public function getRange($start, $end)
    {
		return $this->connection->getRange($this->key, $start, $end);
	}

    /**
	 * 将给定key的值设为value，并返回key的旧值。
	 * 当key存在但不是字符串类型时，返回一个错误。
     * @access public
	 * @param mixed $value
     * @return string|false
	 */
	public function getset($value)
    {
		return $this->connection->getset($this->key, $value);
	}

    /**
	 * 将key中储存的数字值增一。
	 * 如果key不存在，以0为key的初始值，然后执行INCR操作。
	 * 如果值包含错误的类型，或字符串类型的值不能表示为数字，那么返回一个错误。
     * @access public
     * @return int|false
	 */
	public function incr()
    {
		return $connection->incr($this->key);
	}

    /**
	 * 将key所储存的值加上增量value。
	 * 如果key不存在，以0为key的初始值，然后执行INCRBY命令。
	 * 如果值包含错误的类型，或字符串类型的值不能表示为数字，那么返回一个错误。
     * @access public
	 * @param int $value
     * @return int|false
	 */
	public function incrBy($value)
    {
		return $this->connection->incrBy($this->key, $value);
	}

    /**
	 * 将key所储存的值加上增量浮点数value。
	 * 如果key不存在，以0为key的初始值，然后执行INCRBYFLOAT命令。
	 * 如果值包含错误的类型，或字符串类型的值不能表示为数字，那么返回一个错误。
     * @access public
	 * @param float $value
     * @return float|false
	 */
	public function incrByFloat($value)
    {
		return $this->connection->incrByFloat($this->key, $value);
	}

    /**
	 * 返回所有(一个或多个)给定key的值。
	 * 如果某个指定key不存在，返回false。
	 * 因此，该命令永不失败。
     * @access public
     * @return array
	 */
	public function mGet()
    {
		return $this->connection->mGet($this->key);
	}

    /**
	 * 同时设置一个或多个key-value对。
	 * 当发现同名的key存在时，MSET会用新值覆盖旧值，如果你不希望覆盖同名key，请使用MSETNX命令。
     * @access public
	 * @param array $keyValues
     * @return bool
	 */
	public function mSet(array $keyValues)
    {
		return $this->connection->mSet($keyValues);
	}

    /**
	 * 同时设置一个或多个key-value对，当且仅当key不存在。
	 * 当所有key都成功设置，返回1。
	 * 如果所有key都设置失败(最少有一个key已经存在)，那么返回0。
     * @access public
	 * @param array $keyValues
     * @return bool
	 */
	public function mSetNx(array $keyValues)
    {
		return $this->connection->mSetNx($keyValues);
	}

    /**
	 * 将值value关联到key，并将key的生存时间设为expire(以毫秒为单位)。
	 * 如果key 已经存在，SETEX命令将覆写旧值。
	 * 设置成功时返回OK
	 * 当expire参数不合法时，返回一个错误。
     * @access public
	 * @param int $expire
     * @param mixed $value
     * @return bool
	 */
	public function pSetEx($expire, $value)
    {
		return $this->connection->pSetEx($this->key, $expire, $value);
	}

    /**
	 * 将字符串值value关联到key。
	 * 如果key已经持有其他值，SET就覆写旧值，无视类型。
	 * 总是返回OK(TRUE)，因为SET不可能失败。
     * @access public
	 * @param mixed $value
     * @return bool
	 */
	public function set($value)
    {
		return $this->connection->set($this->key, $value);
	}

    /**
	 * 将值value关联到key，并将key的生存时间设为expire(以秒为单位)。
	 * 如果key 已经存在，SETEX命令将覆写旧值。
	 * 设置成功时返回OK
	 * 当expire参数不合法时，返回一个错误。
     * @access public
	 * @param int $expire
     * @param mixed $value
     * @return bool
	 */
	public function setEx($expire, $value)
    {
		return $this->connection->setEx($this->key, $expire, $value);
	}
    
    /**
	 * 将key的值设为value，当且仅当key不存在。
	 * 若给定的key已经存在，则SETNX不做任何动作。
	 * 设置成功，返回true。
	 * 设置失败，返回false。
     * @access public
	 * @param string $value
     * @return bool
	 */
	public function setNx($value)
    {
		return $this->connection->setNx($this->key, $value);
	}
    
    /**
	 * 用value参数覆写(Overwrite)给定key所储存的字符串值，从偏移量offset开始。
	 * 不存在的key当作空白字符串处理。
     * @access public
	 * @param int $offset
	 * @param string $value
     * @return int|false
	 */
	public function setRange($offset, $value)
    {
		return $this->connection->setRange($this->key, $offset, $value);
	}

    /**
	 * 返回key所储存的字符串值的长度。
	 * 当key储存的不是字符串值时，返回一个错误。
     * @access public
     * @return int|false
	 */
	public function strlen()
    {
		return $this->connection->strlen($this->key);
	}
}
