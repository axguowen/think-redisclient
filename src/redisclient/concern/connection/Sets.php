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
 * 集合操作
 */
trait Sets
{
    /**
     * 添加一个或多个元素到集合
     * @access public
     * @param string $key
     * @param mixed $value
     * @param mixed $other_values
     * @return int|false
     */
    public function sAdd($key, $value, ...$other_values)
    {
        return $this->getConnection(true)->sAdd($key, $value, ...$other_values);
    }

    /**
     * 获取集合中的元素数量
     * @access public
     * @param string $key
     * @return int|false
     */
    public function scard($key)
    {
        return $this->getConnection()->scard($key);
    }

    /**
     * 获取两个或多个集合的差集
     * @access public
     * @param string $key 集合键名
     * @param string $other_keys 要比较的集合键名
     * @return array|false
     */
    public function sDiff($key, ...$other_keys)
    {
        return $this->getConnection()->sDiff($key, ...$other_keys);
    }

    /**
     * 此方法与sDiff一样，只是将产生的差集存储在指定的键中
     * @access public
     * @param string $dst 目标键名
     * @param string $key 集合键名
     * @param string $other_keys 要比较的集合键名
     * @return int|false
     */
    public function sDiffStore($dst, $key, ...$other_keys)
    {
        return $this->getConnection(true)->sDiffStore($dst, $key, ...$other_keys);
    }

    /**
     * 返回集合中的所有元素
     * @access public
     * @param array|string $key 集合键名
     * @param string $other_keys
     * @return array|false
     */
    public function sInter($key, ...$other_keys)
    {
        return $this->getConnection()->sInter($key, ...$other_keys);
    }

    /**
     * 计算一个或多个集合的交集，并返回结果的基数
     * @access public
     * @param array $key 集合键名数组
     * @param int $limit
     * @return int|false
     */
    public function sintercard(array $key, $limit = -1)
    {
        return $this->getConnection()->sintercard($key, $limit);
    }

    /**
     * 计算一个或多个集合的交集，并将结果存储在目标键中
     * @access public
     * @param array|string $key 集合键名数组
     * @param string $other_keys 如果第一个参数是字符串，那么后面的参数应该是要计算交集的集合键名
     * @return int|false
     */
    public function sInterStore($key, ...$other_keys)
    {
        return $this->getConnection(true)->sInterStore($key, ...$other_keys);
    }

    /**
     * 查询某个元素是否是集合的成员
     * @access public
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function sismember($key, $value)
    {
        return $this->getConnection()->sismember($key, $value);
    }

    /**
     * 返回集合中的全部成员
     * @access public
     * @param string $key
     * @return array|false
     */
    public function sMembers($key)
    {
        return $this->getConnection()->sMembers($key);
    }

    /**
     * 检查一个或多个值是否为集合的成员
     * @access public
     * @param string $key
     * @param string $member
     * @param string $other_members
     * @return array|false
     */
    public function sMisMember($key, $member, ...$other_members)
    {
        return $this->getConnection()->sMisMember($key, $member, ...$other_members);
    }

    /**
     * 从一个集合中弹出一个成员，然后将其推到另一个集合上。如果目标集合不存在，则创建该集合
     * @access public
     * @param string $key
     * @param string $targetKey
     * @param mixed $value
     * @return bool
     */
    public function sMove($key, $targetKey, $value)
    {
        return $this->getConnection(true)->sMove($key, $targetKey, $value);
    }

    /**
     * 从集合中随机弹出一个或多个元素
     * @access public
     * @param string $key
     * @param int $count
     * @return string|array|false
     */
    public function sPop($key, $count = 1)
    {
        return $this->getConnection(true)->sPop($key, $count);
    }

    /**
     * 随机返回集合中的一个或多个成员
     * @access public
     * @param string $key
     * @param int $count
     * @return string|array|false
     */
    public function sRandMember($key, $count = 1)
    {
        return $this->getConnection()->sRandMember($key, $count);
    }

    /**
     * 从集合中删除一个或多个值
     * @access public
     * @param string $key
     * @param mixed $value
     * @param mixed $other_values
     * @return int|false
     */
    public function srem($key, $value, ...$other_values)
    {
        return $this->getConnection(true)->srem($key, $value, ...$other_values);
    }

    /**
     * 用迭代器扫描集合中的元素
     * @access public
     * @param string $key
     * @param int|null $iterator
     * @param string|null $pattern
     * @param int $count
     * @return array|false
     */
    public function sscan($key, $iterator, $pattern = null, $count = 0)
    {
        return $this->getConnection()->sscan($key, $iterator, $pattern, $count);
    }

    /**
     * 返回一个或多个集合的并集
     * @access public
     * @param string $key
     * @param string $other_keys
     * @return array|false
     */
    public function sUnion($key, ...$other_keys)
    {
        return $this->getConnection()->sUnion($key, ...$other_keys);
    }

    /**
     * 返回一个或多个集合的并集, 并将结果存储到新集合
     * @access public
     * @param string $dst
     * @param string $key
     * @param string $other_keys
     * @return int|false
     */
    public function sUnionStore($dst, $key, ...$other_keys)
    {
        return $this->getConnection(true)->sUnionStore($dst, $key, ...$other_keys);
    }
}
