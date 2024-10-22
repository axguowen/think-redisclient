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
 * 有序集合操作
 */
trait SortedSets
{
    /**
     * 弹出一个或多个有序集合中的一个或多个元素
     * @access public
     * @param float $timeout
     * @param string $from
     * @param int $count
     * @return array|null|false
     */
    public function bzmpop($timeout, $from, $count = 1)
    {
        return $this->connection->bzmpop($timeout, $this->key, $from, $count);
    }

    /**
     * 从一个或多个有序集合中弹出最大得分元素，如果没有可用元素，则阻塞到指定的超时
     * @access public
     * @param string|int $timeout_or_key
     * @param mixed $extra_args
     * @return array|false
     */
    public function bzPopMax($timeout_or_key, ...$extra_args)
    {
        return $this->connection->bzPopMax($this->key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 从一个或多个有序集合中弹出最小得分元素，如果没有可用元素，则阻塞到指定的超时
     * @access public
     * @param string|int $timeout_or_key
     * @param mixed $extra_args
     * @return array|false
     */
    public function bzPopMin($timeout_or_key, ...$extra_args)
    {
        return $this->connection->bzPopMin($this->key, $timeout_or_key, ...$extra_args);
    }

    /**
     * 将一个或多个元素和分数添加到有序集合
     * @access public
     * @param array|float $score_or_options
     * @param mixed $more_scores_and_mems
     * @return int|false
     */
    public function zAdd($score_or_options, ...$more_scores_and_mems)
    {
        return $this->connection->zAdd($this->key, $score_or_options, ...$more_scores_and_mems);
    }

    /**
     * 返回有序集合中的元素数量
     * @access public
     * @return int|false
     */
    public function zCard()
    {
        return $this->connection->zCard($this->key);
    }

    /**
     * 返回有序集合中分数在指定范围内的成员数量
     * @access public
     * @param string $start
     * @param string $end
     * @return int|false
     */
    public function zCount($start, $end)
    {
        return $this->connection->zCount($this->key, $limit);
    }

    /**
     * 返回一个集合与其它集合的差集
     * @access public
     * @param array $options 如果第一个参数是字符串，那么后面的参数应该是要计算交集的集合键名
     * @return array|false
     */
    public function zdiff($options = null)
    {
        return $this->connection->zdiff($this->key, $options);
    }

    /**
     * 返回一个集合与其它集合的差集, 并将结果存储在新的键
     * @access public
     * @param string $dst
     * @return array|false
     */
    public function zdiffstore($dst)
    {
        return $this->connection->zdiffstore($dst, $this->key);
    }

    /**
     * 在有序集合中创建或增加成员的分数
     * @access public
     * @param float $value
     * @param mixed $member
     * @return float|false
     */
    public function zIncrBy($value, $member)
    {
        return $this->connection->zIncrBy($this->key, $value, $member);
    }

    /**
     * 返回多个有序集合的交集
     * @access public
     * @param array|null $weights
     * @param array|null $options
     * @return array|false
     */
    public function zinter($weights = null, $options = null)
    {
        return $this->connection->zinter($this->key, $weights, $options);
    }

    /**
     * 与ZINTER类似，但此命令不是返回相交的值，而是返回相交集的基数
     * @access public
     * @param int $limit
     * @return int|false
     */
    public function zintercard($limit = 1)
    {
        return $this->connection->zintercard($this->key, $limit);
    }

    /**
     * 返回多个有序集合的交集并将结果存储在新的键
     * @access public
     * @param string $dst
     * @param array|null $weights
     * @param string|null $aggregate
     * @return int|false
     */
    public function zinterstore($dst, $weights = null, $aggregate = null)
    {
        return $this->connection->zinterstore($dst, $this->key, $weights, $aggregate);
    }

    /**
     * 返回有序集合中成员位于所提供的值范围内的元素数
     * @access public
     * @param string $min
     * @param string $max
     * @return int|false
     */
    public function zLexCount($min, $max)
    {
        return $this->connection->zLexCount($this->key, $min, $max);
    }

    /**
     * 从一个或多个有序集合中弹出一个或更多最高或最低得分元素
     * @access public
     * @param string $from
     * @param int $count
     * @return array|null|false
     */
    public function zmpop($from, $count = 1)
    {
        return $this->connection->zmpop($this->key, $from, $count);
    }

    /**
     * 检索有序集合一个或多个成员的分数
     * @access public
     * @param mixed $member
     * @param mixed $other_members
     * @return array|false
     */
    public function zMscore($member, ...$other_members)
    {
        return $this->connection->zMscore($this->key, $member, ...$other_members);
    }

    /**
     * 从有序集合中弹出一个或多个得分最高的元素
     * @access public
     * @param int $count
     * @return array|false
     */
    public function zPopMax($count = null)
    {
        return $this->connection->zPopMax($this->key, $count);
    }

    /**
     * 从有序集合中弹出一个或多个得分最低的元素
     * @access public
     * @param int $count
     * @return array|false
     */
    public function zPopMin($count = null)
    {
        return $this->connection->zPopMin($this->key, $count);
    }

    /**
     * 从有序集合中检索一个或多个随机成员
     * @access public
     * @param array $options
     * @return string|array
     */
    public function zRandMember($options = null)
    {
        return $this->connection->zRandMember($this->key, $options);
    }

    /**
     * 检索指定范围之间的元素
     * @access public
     * @param mixed $start
     * @param mixed $end
     * @param array|bool|null $options
     * @return array|false
     */
    public function zRange($start, $end, $options = null)
    {
        return $this->connection->zRange($this->key, $start, $end, $options);
    }

    /**
     * 从按地理范围排序的集合中检索元素范围
     * @access public
     * @param string $min
     * @param string $max
     * @param int $offset
     * @param int $count
     * @return array|false
     */
    public function zRangeByLex($min, $max, $offset = -1, $count = -1)
    {
        return $this->connection->zRangeByLex($this->key, $min, $max, $offset, $count);
    }

    /**
     * 从按地理范围排序的集合中检索元素范围
     * @access public
     * @param string $start
     * @param string $end
     * @param array $options
     * @return array|false
     */
    public function zRangeByScore($start, $end, array $options = [])
    {
        return $this->connection->zRangeByLex($this->key, $start, $end, $options);
    }

    /**
     * 类似于ZRANGE, 但是会将返回值存储在新的键中
     * @access public
     * @param string $dstkey
     * @param string $start
     * @param string $end
     * @param array|bool|null $options
     * @return int|false
     */
    public function zrangestore($dstkey, $start, $end, $options = null)
    {
        return $this->connection->zrangestore($dstkey, $this->srckey, $start, $end, $options);
    }

    /**
     * 按分数获取有序集合中成员的排名
     * @access public
     * @param mixed $member
     * @return int|false
     */
    public function zRank($member)
    {
        return $this->connection->zRank($this->key, $member);
    }

    /**
     * 从有序集合删除一个或多个成员
     * @access public
     * @param mixed $member
     * @param mixed $other_members
     * @return int|false
     */
    public function zRem($member, ...$other_members)
    {
        return $this->connection->zRem($this->key, $member, ...$other_members);
    }

    /**
     * 从按地理范围排序的有序集合中删除零个或多个元素
     * @access public
     * @param string $min
     * @param string $max
     * @return int|false
     */
    public function zRemRangeByLex($min, $max)
    {
        return $this->connection->zRemRangeByLex($this->key, $min, $max);
    }

    /**
     * 按排名删除有序集合的一个或多个成员
     * @access public
     * @param int $start
     * @param int $end
     * @return int|false
     */
    public function zRemRangeByRank($start, $end)
    {
        return $this->connection->zRemRangeByRank($this->key, $start, $end);
    }
    
    /**
     * 按排名删除有序集合的一个或多个成员
     * @access public
     * @param string $start
     * @param string $end
     * @return int|false
     */
    public function zRemRangeByScore($start, $end)
    {
        return $this->connection->zRemRangeByScore($this->key, $start, $end);
    }
    
    /**
     * 按相反顺序列出有序集合的成员
     * @access public
     * @param string $start
     * @param string $end
     * @param mixed $scores
     * @return array|false
     */
    public function zRevRange($start, $end, $scores = null)
    {
        return $this->connection->zRevRange($this->key, $start, $end, $scores);
    }
    
    /**
     * 按相反顺序列出地理范围内有序集合的成员
     * @access public
     * @param string $max
     * @param string $min
     * @param int $offset
     * @param int $count
     * @return array|false
     */
    public function zRevRangeByLex($max, $min, $offset = -1, $count = -1)
    {
        return $this->connection->zRevRangeByLex($this->key, $max, $min, $offset, $count);
    }
    
    /**
     * 按分数从高到低列出有序集合中的元素
     * @access public
     * @param string $max
     * @param string $min
     * @param array|bool $options
     * @return array|false
     */
    public function zRevRangeByScore($max, $min, $options = [])
    {
        return $this->connection->zRevRangeByScore($this->key, $max, $min, $options);
    }
    
    /**
     * 按反向排列检索有序集合的成员
     * @access public
     * @param mixed $member
     * @return int|false
     */
    public function zRevRank($member)
    {
        return $this->connection->zRevRank($this->key, $member);
    }
    
    /**
     * 使用迭代器扫描有序集合的成员
     * @access public
     * @param int|null $iterator
     * @param string|null $pattern
     * @param int $count
     * @return array|false
     */
    public function zscan($iterator, $pattern = null, $count = 0)
    {
        return $this->connection->zscan($this->key, $iterator, $pattern, $count);
    }
    
    /**
     * 返回有序集合中元素的分数
     * @access public
     * @param mixed $member
     * @return float|false
     */
    public function zScore($member)
    {
        return $this->connection->zScore($this->key, $member);
    }
    
    /**
     * 返回一个或多个有序集合的并集
     * @access public
     * @param array|null $weights
     * @param array|null $options
     * @return array|false
     */
    public function zunion($weights = null, $options = null)
    {
        return $this->connection->zunion($this->key, $weights, $options);
    }
    
    /**
     * 返回一个或多个有序集合的并集, 并将结果存储在新的键
     * @access public
     * @param string $dst
     * @param array|null $weights
     * @param string|null $aggregate
     * @return array|false
     */
    public function zunionstore($dst, $weights = null, $aggregate = null)
    {
        return $this->connection->zunionstore($dst, $this->key, $weights, $aggregate);
    }
}
