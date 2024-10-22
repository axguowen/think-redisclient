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
 * 链表操作
 */
trait Lists
{
    /**
     * 从一个或多个链表中弹出一个或更多个元素，可能会阻塞指定的超时
     * @access public
     * @param int $timeout 没有元素时最大阻塞时间
     * @param array $keys
     * @param array $from 从开头或结尾处弹出,可选值LEFT,RIGTHT
     * @param int $count 弹出数量
     * @return array|null|false
     */
    public function blmpop($timeout, array $keys, $from, $count = 1)
    {
        return $this->getConnection(true)->blmpop($timeout, $key, $from, $count);
    }

    /**
     * 从一个或多个链表的开头弹出一个元素，可能会阻塞指定的超时
     * @access public
     * @param string|array $key
     * @param string|float|int $timeout_or_key 如果上一个参数是字符串键，则它可以是附加键，也可以是超时时间
     * @param mixed $extra_args
     * @return array|null|false
     */
    public function blPop($key, $timeout_or_key, ...$extra_args)
    {
        return $this->getConnection(true)->blPop($key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 从一个或多个链表的末尾弹出一个元素，可能会阻塞指定的超时
     * @access public
     * @param string|array $key
     * @param string|float|int $timeout_or_key 如果上一个参数是字符串键，则它可以是附加键，也可以是超时时间
     * @param mixed $extra_args
     * @return array|null|false
     */
    public function brPop($key, $timeout_or_key, ...$extra_args)
    {
        return $this->getConnection(true)->brPop($key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 从一个链表的末尾弹出一个元素，将其推到另一个链表的开头，可能会阻塞指定的超时
     * @access public
     * @param string $key
     * @param string $targetKey
     * @param int|float $timeout 最大阻塞时间
     * @return string|false
     */
    public function brpoplpush($key, $targetKey, $timeout)
    {
        return $this->getConnection(true)->brpoplpush($key, $targetKey, $timeout);
    }

    /**
     * 通过索引获取链表中的元素
     * @access public
     * @param string $key
     * @param int $index
     * @return mixed
     */
    public function lindex($key, $index)
    {
        return $this->getConnection()->lindex($key, $index);
    }

    /**
     * 在链表中某个元素之前或之后插入一个元素
     * @access public
     * @param string $key
     * @param string $pos
     * @param mixed $pivot
     * @param mixed $value
     * @return int|false
     */
    public function lInsert($key, $pos, $pivot, $value)
    {
        return $this->getConnection(true)->lInsert($key, $pos, $pivot, $value);
    }

    /**
     * 获取链表中元素的数量
     * @access public
     * @param string $key
     * @return int|false
     */
    public function lLen($key)
    {
        return $this->getConnection()->lLen($key);
    }

    /**
     * 将链表中的一个元素移动到另一个链表
     * @access public
     * @param string $key
     * @param string $targetKey
     * @param string $wherefrom
     * @param string $whereto
     * @return string|false
     */
    public function lMove($key, $targetKey, $wherefrom, $whereto)
    {
        return $this->getConnection(true)->lMove($key, $targetKey, $wherefrom, $whereto);
    }
    
    /**
     * 从一个或多个链表中弹出一个或更多个元素
     * @access public
     * @param array $keys
     * @param array $from 从开头或结尾处弹出,可选值LEFT,RIGTHT
     * @param int $count 弹出数量
     * @return array|null|false
     */
    public function lmpop($keys, $from, $count = 1)
    {
        return $this->getConnection(true)->lmpop($keys, $from, $count);
    }
    
    /**
     * 从链表中弹出一个或多个元素
     * @access public
     * @param string $key
     * @param int $count 弹出数量
     * @return bool|string|array
     */
    public function lPop($key, $count = 1)
    {
        return $this->getConnection(true)->lPop($key, $count);
    }
    
    /**
     * 返回链表中某个元素的索引
     * @access public
     * @param string $key
     * @param mixed $value 元素的值
     * @param array $options 选项
     * @return null|bool|int|array
     */
    public function lPos($key, $value, $options = null)
    {
        return $this->getConnection()->lPos($key, $value, $options);
    }
    
    /**
     * 从链表开头塞入一个或多个元素
     * @access public
     * @param string $key
     * @param mixed $elements 元素
     * @return int|false
     */
    public function lPush($key, ...$elements)
    {
        return $this->getConnection(true)->lPush($key, ...$elements);
    }
    
    /**
     * 从链表开头塞入一个元素, 链表不存在则忽略
     * @access public
     * @param string $key
     * @param mixed $value 元素
     * @return int|false
     */
    public function lPushx($key, $value)
    {
        return $this->getConnection(true)->lPushx($key, $value);
    }
    
    /**
     * 从链表中返回指定索引范围的元素
     * @access public
     * @param string $key
     * @param int $start 起始索引
     * @param int $end 结束索引
     * @return int|false
     */
    public function lrange($key, $start, $end)
    {
        return $this->getConnection()->lrange($key, $start, $end);
    }
    
    /**
     * 从链表中删除一个或多个元素
     * @access public
     * @param string $key
     * @param mixed $value 元素值
     * @param int $count 数量
     * @return int|false
     */
    public function lrem($key, $value, $count = 0)
    {
        return $this->getConnection(true)->lrem($key, $value, $count = 0);
    }
    
    /**
     * 从链表中某个索引的元素设置为特定值
     * @access public
     * @param string $key
     * @param int $index 索引
     * @param mixed $value 值
     * @return bool
     */
    public function lSet($key, $index, $value)
    {
        return $this->getConnection(true)->lSet($key, $index, $value);
    }
    
    /**
     * 将链表修剪到指定索引范围
     * @access public
     * @param string $key
     * @param int $start 起始索引
     * @param int $end 结束索引
     * @return bool
     */
    public function ltrim($key, $start, $end)
    {
        return $this->getConnection(true)->ltrim($key, $start, $end);
    }
    
    /**
     * 从链表末尾弹出一个或多个元素
     * @access public
     * @param string $key
     * @return array|string|bool
     */
    public function rPop($key)
    {
        return $this->getConnection(true)->rPop($key);
    }

    /**
     * 从一个链表的末尾弹出一个元素，将其推到另一个链表的开头
     * @access public
     * @param string $key
     * @param string $targetKey
     * @return string|false
     */
    public function rpoplpush($key, $targetKey)
    {
        return $this->getConnection(true)->rpoplpush($key, $targetKey);
    }
    
    /**
     * 从链表尾部塞入一个或多个元素
     * @access public
     * @param string $key
     * @param mixed $elements 元素
     * @return int|false
     */
    public function rPush($key, ...$elements)
    {
        return $this->getConnection(true)->rPush($key, ...$elements);
    }
    
    /**
     * 从链表尾部塞入一个元素, 如果链表不存在则忽略
     * @access public
     * @param string $key
     * @param mixed $value 元素
     * @return int|false
     */
    public function rPushx($key, $value)
    {
        return $this->getConnection(true)->rPushx($key, $value);
    }
}
