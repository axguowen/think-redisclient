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
 * 有序集合操作
 */
trait SortedSets
{
    /**
     * 弹出一个或多个有序集合中的一个或多个元素
     * @access public
     * @param float $timeout
     * @param array $keys
     * @param string $from
     * @param int $count
     * @return array|null|false
     */
    public function bzmpop($timeout, $keys, $from, $count = 1)
    {
        return $this->getConnection(true)->bzmpop($timeout, $keys, $from, $count);
    }

    /**
     * 从一个或多个有序集合中弹出最大得分元素，如果没有可用元素，则阻塞到指定的超时
     * @access public
     * @param string|array $key
     * @param string|int $timeout_or_key
     * @param mixed $extra_args
     * @return array|false
     */
    public function bzPopMax($key, $timeout_or_key, ...$extra_args)
    {
        return $this->getConnection(true)->bzPopMax($key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 从一个或多个有序集合中弹出最小得分元素，如果没有可用元素，则阻塞到指定的超时
     * @access public
     * @param string|array $key
     * @param string|int $timeout_or_key
     * @param mixed $extra_args
     * @return array|false
     */
    public function bzPopMin($key, $timeout_or_key, ...$extra_args)
    {
        return $this->getConnection(true)->bzPopMin($key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 将一个或多个元素和分数添加到有序集合
     * @access public
     * @param string $key
     * @param array|float $score_or_options
     * @param mixed $more_scores_and_mems
     * @return int|false
     */
    public function zAdd($key, $score_or_options, ...$more_scores_and_mems)
    {
        return $this->getConnection(true)->zAdd($key, $score_or_options, ...$more_scores_and_mems);
    }

    /**
     * 返回有序集合中的元素数量
     * @access public
     * @param string $key
     * @return int|false
     */
    public function zCard($key)
    {
        return $this->getConnection()->zCard($key);
    }

    /**
     * 返回有序集合中分数在指定范围内的成员数量
     * @access public
     * @param array $keys
     * @param string $start
     * @param string $end
     * @return int|false
     */
    public function zCount($keys, $start, $end)
    {
        return $this->getConnection()->zCount($keys, $limit);
    }

    /**
     * 返回一个集合与其它集合的差集
     * @access public
     * @param array $keys
     * @param array $options 如果第一个参数是字符串，那么后面的参数应该是要计算交集的集合键名
     * @return array|false
     */
    public function zdiff($keys, array $options = null)
    {
        return $this->getConnection()->zdiff($keys, $options);
    }

    /**
     * 返回一个集合与其它集合的差集, 并将结果存储在新的键
     * @access public
     * @param string $dst
     * @param array $keys
     * @return array|false
     */
    public function zdiffstore($dst, $keys)
    {
        return $this->getConnection(true)->zdiffstore($dst, $keys);
    }

    /**
     * 在有序集合中创建或增加成员的分数
     * @access public
     * @param string $key
     * @param float $value
     * @param mixed $member
     * @return float|false
     */
    public function zIncrBy($key, $value, $member)
    {
        return $this->getConnection(true)->zIncrBy($key, $value, $member);
    }

    /**
     * 返回多个有序集合的交集
     * @access public
     * @param array $keys
     * @param array|null $weights
     * @param array|null $options
     * @return array|false
     */
    public function zinter($keys, $weights = null, $options = null)
    {
        return $this->getConnection()->zinter($keys, $weights, $options);
    }

    /**
     * 与ZINTER类似，但此命令不是返回相交的值，而是返回相交集的基数
     * @access public
     * @param array $keys
     * @param int $limit
     * @return int|false
     */
    public function zintercard($keys, $limit = 1)
    {
        return $this->getConnection()->zintercard($keys, $limit);
    }

    /**
     * 返回多个有序集合的交集并将结果存储在新的键
     * @access public
     * @param string $dst
     * @param array $keys
     * @param array|null $weights
     * @param string|null $aggregate
     * @return int|false
     */
    public function zinterstore($dst, $keys, $weights = null, $aggregate = null)
    {
        return $this->getConnection(true)->zinterstore($dst, $keys, $weights, $aggregate);
    }

    /**
     * 返回有序集合中成员位于所提供的值范围内的元素数
     * @access public
     * @param string $key
     * @param string $min
     * @param string $max
     * @return int|false
     */
    public function zLexCount($key, $min, $max)
    {
        return $this->getConnection()->zLexCount($key, $min, $max);
    }

    /**
     * 从一个或多个有序集合中弹出一个或更多最高或最低得分元素
     * @access public
     * @param array $keys
     * @param string $from
     * @param int $count
     * @return array|null|false
     */
    public function zmpop($keys, $from, $count = 1)
    {
        return $this->getConnection(true)->zmpop($keys, $from, $count);
    }

    /**
     * 检索有序集合一个或多个成员的分数
     * @access public
     * @param string $key
     * @param mixed $member
     * @param mixed $other_members
     * @return array|false
     */
    public function zMscore($key, $member, ...$other_members)
    {
        return $this->getConnection()->zMscore($key, $member, ...$other_members);
    }

    /**
     * 从有序集合中弹出一个或多个得分最高的元素
     * @access public
     * @param string $key
     * @param int $count
     * @return array|false
     */
    public function zPopMax($key, $count = null)
    {
        return $this->getConnection(true)->zPopMax($key, $count);
    }

    /**
     * 从有序集合中弹出一个或多个得分最低的元素
     * @access public
     * @param string $key
     * @param int $count
     * @return array|false
     */
    public function zPopMin($key, $count = null)
    {
        return $this->getConnection(true)->zPopMin($key, $count);
    }

    /**
     * 从有序集合中检索一个或多个随机成员
     * @access public
     * @param string $key
     * @param array $options
     * @return string|array
     */
    public function zRandMember($key, $options = null)
    {
        return $this->getConnection()->zRandMember($key, $options);
    }

    /**
     * 检索指定范围之间的元素
     * @access public
     * @param string $key
     * @param mixed $start
     * @param mixed $end
     * @param array|bool|null $options
     * @return array|false
     */
    public function zRange($key, $start, $end, $options = null)
    {
        return $this->getConnection()->zRange($key, $start, $end, $options);
    }

    /**
     * 从按地理范围排序的集合中检索元素范围
     * @access public
     * @param string $key
     * @param string $min
     * @param string $max
     * @param int $offset
     * @param int $count
     * @return array|false
     */
    public function zRangeByLex($key, $min, $max, $offset = -1, $count = -1)
    {
        return $this->getConnection()->zRangeByLex($key, $min, $max, $offset, $count);
    }

    /**
     * 从按地理范围排序的集合中检索元素范围
     * @access public
     * @param string $key
     * @param string $start
     * @param string $end
     * @param array $options
     * @return array|false
     */
    public function zRangeByScore($key, $start, $end, array $options = [])
    {
        return $this->getConnection()->zRangeByLex($key, $start, $end, $options);
    }

    /**
     * 类似于ZRANGE, 但是会将返回值存储在新的键中
     * @access public
     * @param string $dstkey
     * @param string $srckey
     * @param string $start
     * @param string $end
     * @param array|bool|null $options
     * @return int|false
     */
    public function zrangestore($dstkey, $srckey, $start, $end, $options = null)
    {
        return $this->getConnection(true)->zrangestore($dstkey, $srckey, $start, $end, $options);
    }

    /**
     * 按分数获取有序集合中成员的排名
     * @access public
     * @param string $key
     * @param mixed $member
     * @return int|false
     */
    public function zRank($key, $member)
    {
        return $this->getConnection()->zRank($key, $member);
    }

    /**
     * 从有序集合删除一个或多个成员
     * @access public
     * @param string $key
     * @param mixed $member
     * @param mixed $other_members
     * @return int|false
     */
    public function zRem($key, $member, ...$other_members)
    {
        return $this->getConnection(true)->zRem($key, $member, ...$other_members);
    }

    /**
     * 从按地理范围排序的有序集合中删除零个或多个元素
     * @access public
     * @param string $key
     * @param string $min
     * @param string $max
     * @return int|false
     */
    public function zRemRangeByLex($key, $min, $max)
    {
        return $this->getConnection(true)->zRemRangeByLex($key, $min, $max);
    }

    /**
     * 按排名删除有序集合的一个或多个成员
     * @access public
     * @param string $key
     * @param int $start
     * @param int $end
     * @return int|false
     */
    public function zRemRangeByRank($key, $start, $end)
    {
        return $this->getConnection(true)->zRemRangeByRank($key, $start, $end);
    }
    
    /**
     * 按排名删除有序集合的一个或多个成员
     * @access public
     * @param string $key
     * @param string $start
     * @param string $end
     * @return int|false
     */
    public function zRemRangeByScore($key, $start, $end)
    {
        return $this->getConnection(true)->zRemRangeByScore($key, $start, $end);
    }
    
    /**
     * 按相反顺序列出有序集合的成员
     * @access public
     * @param string $key
     * @param string $start
     * @param string $end
     * @param mixed $scores
     * @return array|false
     */
    public function zRevRange($key, $start, $end, $scores = null)
    {
        return $this->getConnection()->zRevRange($key, $start, $end, $scores);
    }
    
    /**
     * 按相反顺序列出地理范围内有序集合的成员
     * @access public
     * @param string $key
     * @param string $max
     * @param string $min
     * @param int $offset
     * @param int $count
     * @return array|false
     */
    public function zRevRangeByLex($key, $max, $min, $offset = -1, $count = -1)
    {
        return $this->getConnection()->zRevRangeByLex($key, $max, $min, $offset, $count);
    }
    
    /**
     * 按分数从高到低列出有序集合中的元素
     * @access public
     * @param string $key
     * @param string $max
     * @param string $min
     * @param array|bool $options
     * @return array|false
     */
    public function zRevRangeByScore($key, $max, $min, $options = [])
    {
        return $this->getConnection()->zRevRangeByScore($key, $max, $min, $options);
    }
    
    /**
     * 按反向排列检索有序集合的成员
     * @access public
     * @param string $key
     * @param mixed $member
     * @return int|false
     */
    public function zRevRank($key, $member)
    {
        return $this->getConnection()->zRevRank($key, $member);
    }
    
    /**
     * 使用迭代器扫描有序集合的成员
     * @access public
     * @param string $key
     * @param int|null $iterator
     * @param string|null $pattern
     * @param int $count
     * @return array|false
     */
    public function zscan($key, $iterator, $pattern = null, $count = 0)
    {
        return $this->getConnection()->zscan($key, $iterator, $pattern, $count);
    }
    
    /**
     * 返回有序集合中元素的分数
     * @access public
     * @param string $key
     * @param mixed $member
     * @return float|false
     */
    public function zScore($key, $member)
    {
        return $this->getConnection()->zScore($key, $member);
    }
    
    /**
     * 返回一个或多个有序集合的并集
     * @access public
     * @param array $keys
     * @param array|null $weights
     * @param array|null $options
     * @return array|false
     */
    public function zunion($keys, $weights = null, $options = null)
    {
        return $this->getConnection()->zunion($keys, $weights, $options);
    }
    
    /**
     * 返回一个或多个有序集合的并集, 并将结果存储在新的键
     * @access public
     * @param string $dst
     * @param array $keys
     * @param array|null $weights
     * @param string|null $aggregate
     * @return array|false
     */
    public function zunionstore($dst, $keys, $weights = null, $aggregate = null)
    {
        return $this->getConnection(true)->zunionstore($dst, $keys, $weights, $aggregate);
    }
}
