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
 * 链表操作
 */
trait Lists
{
    /**
     * 从一个或多个链表中弹出一个或更多个元素，可能会阻塞指定的超时
     * @access public
     * @param int $timeout 没有元素时最大阻塞时间
     * @param array $from 从开头或结尾处弹出,可选值LEFT,RIGTHT
     * @param int $count 弹出数量
     * @return array|null|false
     */
    public function blmpop($timeout, $from, $count = 1)
    {
        return $this->connection->blmpop($timeout, $this->key, $from, $count);
    }

    /**
     * 从一个或多个链表的开头弹出一个元素，可能会阻塞指定的超时
     * @access public
     * @param string|float|int $timeout_or_key 如果上一个参数是字符串键，则它可以是附加键，也可以是超时时间
     * @param mixed $extra_args
     * @return array|null|false
     */
    public function blPop($timeout_or_key, ...$extra_args)
    {
        return $this->connection->blPop($this->key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 从一个或多个链表的末尾弹出一个元素，可能会阻塞指定的超时
     * @access public
     * @param string|float|int $timeout_or_key 如果上一个参数是字符串键，则它可以是附加键，也可以是超时时间
     * @param mixed $extra_args
     * @return array|null|false
     */
    public function brPop($timeout_or_key, ...$extra_args)
    {
        return $this->connection->brPop($this->key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 从一个链表的末尾弹出一个元素，将其推到另一个链表的开头，可能会阻塞指定的超时
     * @access public
     * @param string $targetKey
     * @param int|float $timeout 最大阻塞时间
     * @return string|false
     */
    public function brpoplpush($targetKey, $timeout)
    {
        return $this->connection->brpoplpush($this->key, $targetKey, $timeout);
    }

    /**
     * 通过索引获取链表中的元素
     * @access public
     * @param int $index
     * @return mixed
     */
    public function lindex($index)
    {
        return $this->connection->lindex($this->key, $index);
    }

    /**
     * 在链表中某个元素之前或之后插入一个元素
     * @access public
     * @param string $pos
     * @param mixed $pivot
     * @param mixed $value
     * @return int|false
     */
    public function lInsert($pos, $pivot, $value)
    {
        return $this->connection->lInsert($this->key, $pos, $pivot, $value);
    }

    /**
     * 获取链表中元素的数量
     * @access public
     * @return int|false
     */
    public function lLen()
    {
        return $this->connection->lLen($this->key);
    }

    /**
     * 将链表中的一个元素移动到另一个链表
     * @access public
     * @param string $targetKey
     * @param string $wherefrom
     * @param string $whereto
     * @return string|false
     */
    public function lMove($targetKey, $wherefrom, $whereto)
    {
        return $this->connection->lMove($this->key, $targetKey, $wherefrom, $whereto);
    }
    
    /**
     * 从一个或多个链表中弹出一个或更多个元素
     * @access public
     * @param array $from 从开头或结尾处弹出,可选值LEFT,RIGTHT
     * @param int $count 弹出数量
     * @return array|null|false
     */
    public function lmpop($from, $count = 1)
    {
        return $this->connection->lmpop($this->keys, $from, $count);
    }
    
    /**
     * 从链表中弹出一个或多个元素
     * @access public
     * @param int $count 弹出数量
     * @return bool|string|array
     */
    public function lPop($count = 1)
    {
        return $this->connection->lPop($this->key, $count);
    }
    
    /**
     * 返回链表中某个元素的索引
     * @access public
     * @param mixed $value 元素的值
     * @param array $options 选项
     * @return null|bool|int|array
     */
    public function lPos($value, $options = null)
    {
        return $this->connection->lPos($this->key, $value, $options);
    }
    
    /**
     * 从链表开头塞入一个或多个元素
     * @access public
     * @param mixed $elements 元素
     * @return int|false
     */
    public function lPush(...$elements)
    {
        return $this->connection->lPush($this->key, ...$elements);
    }
    
    /**
     * 从链表开头塞入一个元素, 链表不存在则忽略
     * @access public
     * @param mixed $value 元素
     * @return int|false
     */
    public function lPushx($value)
    {
        return $this->connection->lPushx($this->key, $value);
    }
    
    /**
     * 从链表中返回指定索引范围的元素
     * @access public
     * @param int $start 起始索引
     * @param int $end 结束索引
     * @return int|false
     */
    public function lrange($start, $end)
    {
        return $this->connection->lrange($this->key, $start, $end);
    }
    
    /**
     * 从链表中删除一个或多个元素
     * @access public
     * @param mixed $value 元素值
     * @param int $count 数量
     * @return int|false
     */
    public function lrem($value, $count = 0)
    {
        return $this->connection->lrem($this->key, $value, $count = 0);
    }
    
    /**
     * 从链表中某个索引的元素设置为特定值
     * @access public
     * @param int $index 索引
     * @param mixed $value 值
     * @return bool
     */
    public function lSet($index, $value)
    {
        return $this->connection->lSet($this->key, $index, $value);
    }
    
    /**
     * 将链表修剪到指定索引范围
     * @access public
     * @param int $start 起始索引
     * @param int $end 结束索引
     * @return bool
     */
    public function ltrim($start, $end)
    {
        return $this->connection->ltrim($this->key, $start, $end);
    }
    
    /**
     * 从链表末尾弹出一个或多个元素
     * @access public
     * @return array|string|bool
     */
    public function rPop()
    {
        return $this->connection->rPop($this->key);
    }

    /**
     * 从一个链表的末尾弹出一个元素，将其推到另一个链表的开头
     * @access public
     * @param string $targetKey
     * @return string|false
     */
    public function rpoplpush($targetKey)
    {
        return $this->connection->rpoplpush($this->key, $targetKey);
    }
    
    /**
     * 从链表尾部塞入一个或多个元素
     * @access public
     * @param mixed $elements 元素
     * @return int|false
     */
    public function rPush(...$elements)
    {
        return $this->connection->rPush($this->key, ...$elements);
    }
    
    /**
     * 从链表尾部塞入一个元素, 如果链表不存在则忽略
     * @access public
     * @param mixed $value 元素
     * @return int|false
     */
    public function rPushx($value)
    {
        return $this->connection->rPushx($this->key, $value);
    }
}
