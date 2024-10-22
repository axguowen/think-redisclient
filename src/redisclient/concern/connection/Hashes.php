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
 * 哈希操作
 */
trait Hashes
{
    /**
     * 从哈希中删除一个或多个字段
     * @access public
     * @param string $key
     * @param string $field 字段名
     * @param string $other_fields 额外的字段
     * @return int|false
     */
    public function hDel($key, $field, ...$other_fields)
    {
        return $this->getConnection(true)->hDel($key, $field, ...$other_fields);
    }

    /**
     * 检查哈希中是否存在某个字段
     * @access public
     * @param string $key
     * @param string $field 字段名
     * @return bool
     */
    public function hExists($key, $field)
    {
        return $this->getConnection()->hExists($key, $field);
    }

    /**
     * 查询哈希中某个字段的值
     * @access public
     * @param string $key
     * @param string $field 字段名
     * @return mixed
     */
    public function hGet($key, $field)
    {
        return $this->getConnection()->hGet($key, $field);
    }

    /**
     * 查询哈希中全部字段的值
     * @access public
     * @param string $key
     * @return array|false
     */
    public function hGetAll($key)
    {
        return $this->getConnection()->hGetAll($key);
    }

    /**
     * 将哈希中某个字段自增一个整数
     * @access public
     * @param string $key
     * @param string $field
     * @param int $value
     * @return int|false
     */
    public function hIncrBy($key, $field, $value)
    {
        return $this->getConnection(true)->hIncrBy($key, $field, $value);
    }

    /**
     * 将哈希中某个字段自增一个浮点数
     * @access public
     * @param string $key
     * @param string $field
     * @param float $value
     * @return float|false
     */
    public function hIncrByFloat($key, $field, $value)
    {
        return $this->getConnection(true)->hIncrByFloat($key, $field, $value);
    }

    /**
     * 返回哈希的所有字段名
     * @access public
     * @param string $key
     * @return array|false
     */
    public function hKeys($key)
    {
        return $this->getConnection()->hKeys($key);
    }

    /**
     * 返回哈希的字段数量
     * @access public
     * @param string $key
     * @return int|false
     */
    public function hLen($key)
    {
        return $this->getConnection()->hLen($key);
    }

    /**
     * 获取哈希中一个或多个字段
     * @access public
     * @param string $key
     * @param array $fields
     * @return array|false
     */
    public function hMget($key, array $fields)
    {
        return $this->getConnection()->hMget($key, $fields);
    }

    /**
     * 给哈希添加或更新一个或多个字段和值
     * @access public
     * @param string $key
     * @param array $fieldvals
     * @return bool
     */
    public function hMset($key, array $fieldvals)
    {
        return $this->getConnection(true)->hMset($key, $fieldvals);
    }

    /**
     * 获取哈希中一个或多个随机字段
     * @access public
     * @param string $key
     * @param array $options
     * @return string|array
     */
    public function hRandField($key, array $options)
    {
        return $this->getConnection()->hRandField($key, $fieldvals);
    }

    /**
     * 以增量方式迭代哈希的字段和值
     * @access public
     * @param string $key
     * @param int|null $iterator
     * @param string|null $pattern
     * @param int $count
     * @return array|bool
     */
    public function hscan($key, $iterator, $pattern = null, $count = 0)
    {
        return $this->getConnection()->hscan($key, $iterator, $pattern, $count);
    }

    /**
     * 给哈希添加或更新一个字段
     * @access public
     * @param string $key
     * @param string $field
     * @param mixed $value
     * @return int|false
     */
    public function hSet($key, $field, $value)
    {
        return $this->getConnection(true)->hSet($key, $field, $value);
    }

    /**
     * 当哈希中不存在字段的时候设置哈希字段的值
     * @access public
     * @param string $key
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    public function hSetNx($key, $field, $value)
    {
        return $this->getConnection(true)->hSetNx($key, $field, $value);
    }

    /**
     * 获取哈希字段值的长度
     * @access public
     * @param string $key
     * @param string $field
     * @return bool
     */
    public function hStrLen($key, $field)
    {
        return $this->getConnection()->hStrLen($key, $field);
    }

    /**
     * 返回哈希的所有字段名
     * @access public
     * @param string $key
     * @return array|false
     */
    public function hVals($key)
    {
        return $this->getConnection()->hVals($key);
    }
}
