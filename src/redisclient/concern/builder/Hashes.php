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
 * 哈希操作
 */
trait Hashes
{
    /**
     * 从哈希中删除一个或多个字段
     * @access public
     * @param string $field 字段名
     * @param string $other_fields 额外的字段
     * @return int|false
     */
    public function hDel($field, ...$other_fields)
    {
        return $this->connection->hDel($this->key, $field, ...$other_fields);
    }

    /**
     * 检查哈希中是否存在某个字段
     * @access public
     * @param string $field 字段名
     * @return bool
     */
    public function hExists($field)
    {
        return $this->connection->hExists($this->key, $field);
    }

    /**
     * 查询哈希中某个字段的值
     * @access public
     * @param string $field 字段名
     * @return mixed
     */
    public function hGet($field)
    {
        return $this->connection->hGet($this->key, $field);
    }

    /**
     * 查询哈希中全部字段的值
     * @access public
     * @return array|false
     */
    public function hGetAll()
    {
        return $this->connection->hGetAll($this->key);
    }

    /**
     * 将哈希中某个字段自增一个整数
     * @access public
     * @param string $field
     * @param int $value
     * @return int|false
     */
    public function hIncrBy($field, $value)
    {
        return $this->connection->hIncrBy($this->key, $field, $value);
    }

    /**
     * 将哈希中某个字段自增一个浮点数
     * @access public
     * @param string $field
     * @param float $value
     * @return float|false
     */
    public function hIncrByFloat($field, $value)
    {
        return $this->connection->hIncrByFloat($this->key, $field, $value);
    }

    /**
     * 返回哈希的所有字段名
     * @access public
     * @return array|false
     */
    public function hKeys()
    {
        return $this->connection->hKeys($this->key);
    }

    /**
     * 返回哈希的字段数量
     * @access public
     * @return int|false
     */
    public function hLen()
    {
        return $this->connection->hLen($this->key);
    }

    /**
     * 获取哈希中一个或多个字段
     * @access public
     * @param array $fields
     * @return array|false
     */
    public function hMget(array $fields)
    {
        return $this->connection->hMget($this->key, $fields);
    }

    /**
     * 给哈希添加或更新一个或多个字段和值
     * @access public
     * @param array $fieldvals
     * @return bool
     */
    public function hMset(array $fieldvals)
    {
        return $this->connection->hMset($this->key, $fieldvals);
    }

    /**
     * 获取哈希中一个或多个随机字段
     * @access public
     * @param array $options
     * @return string|array
     */
    public function hRandField(array $options)
    {
        return $this->connection->hRandField($this->key, $fieldvals);
    }

    /**
     * 以增量方式迭代哈希的字段和值
     * @access public
     * @param int|null $iterator
     * @param string|null $pattern
     * @param int $count
     * @return array|bool
     */
    public function hscan($iterator, $pattern = null, $count = 0)
    {
        return $this->connection->hscan($this->key, $iterator, $pattern, $count);
    }

    /**
     * 给哈希添加或更新一个字段
     * @access public
     * @param string $field
     * @param mixed $value
     * @return int|false
     */
    public function hSet($field, $value)
    {
        return $this->connection->hSet($this->key, $field, $value);
    }

    /**
     * 当哈希中不存在字段的时候设置哈希字段的值
     * @access public
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    public function hSetNx($field, $value)
    {
        return $this->connection->hSetNx($this->key, $field, $value);
    }

    /**
     * 获取哈希字段值的长度
     * @access public
     * @param string $field
     * @return bool
     */
    public function hStrLen($field)
    {
        return $this->connection->hStrLen($this->key, $field);
    }

    /**
     * 返回哈希的所有字段名
     * @access public
     * @return array|false
     */
    public function hVals()
    {
        return $this->connection->hVals($this->key);
    }
}
