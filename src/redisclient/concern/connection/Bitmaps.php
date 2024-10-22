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
 * 字符串操作
 */
trait Bitmaps
{
    /**
     * 计算字符串中设置的位数（总体计数）
     * @access public
     * @param string $key
     * @param int $start 起始位置
     * @param int $end 结束位置
     * @param bool $bybit 如果为true,Redis将把$start和$end视为BIT值,而不是字节,所以如果start为0,end为2,Redis只搜索前两个比特
     * @return int|false
     */
    public function bitcount($key, $start = 0, $end = -1, $bybit = false)
    {
        return $this->getConnection()->bitcount($key, $start = 0, $end = -1, $bybit = false);
    }

    /**
     * 返回字符串中设置为1或0的第一个位的位置
     * @access public
     * @param string $key 
     * @param bool $bit 查找0位还是1位
     * @param int $start 起始位置
     * @param int $end 结束位置
     * @param bool $bybit 如果为true,Redis将把$start和$end视为BIT值,而不是字节,所以如果start为0,end为2,Redis只搜索前两个比特
     * @return int|false
     */
    public function bitpos($key, $bit, $start = 0, $end = -1, $bybit = false)
    {
        return $this->getConnection()->bitpos($key, $bit, $start = 0, $end = -1, $bybit = false);
    }

    /**
	 * 返回存储在键处的字符串值中偏移量处的位值
     * @access public
	 * @param string $key
	 * @param int $index
     * @return int|false
	 */
	public function getBit($key, $index)
    {
		return $this->getConnection()->getBit($key, $index);
	}

    /**
	 * 设置或清除存储在键处的字符串值中偏移处的位
     * @access public
	 * @param string $key
	 * @param int $index
	 * @param bool $value 是将位设置为0还是1
     * @return int|false
	 */
	public function setBit($key, $index, $value)
    {
		return $this->getConnection(true)->setBit($key, $index, $value);
	}
}
