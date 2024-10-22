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
 * 地理空间操作
 */
trait Geospatial
{
    /**
     * 向某个地理空间添加一个或多个成员
     * @access public
     * @param float $lng 经度
     * @param float $lat 纬度
     * @param string $member 成员名称
     * @return int|false
     */
    public function geoadd($lng, $lat, $member)
    {
        return $this->connection->geoadd($this->key, $lng, $lat, $member);
    }

    /**
     * 获取某地理空间两个成员之间的距离
     * @access public
     * @param string $memberFirst 第一个成员
     * @param string $memberSecond 第二个成员
     * @param string|null $unit 单位
     * @return float|false
     */
    public function geodist($memberFirst, $memberSecond, $unit = null)
    {
        return $this->connection->geodist($this->key, $memberFirst, $memberSecond, $unit);
    }

    /**
     * 查询一个或多个成员的GeoHash编码字符串
     * @access public
     * @param string $member 成员
     * @param string $other_members 更多成员
     * @return array|false
     */
    public function geohash($member, ...$other_members)
    {
        return $this->connection->geohash($this->key, $member, ...$other_members);
    }

    /**
     * 查询地一个或多个成员的经纬度
     * @access public
     * @param string $member 成员
     * @param string $other_members 更多成员
     * @return array|false
     */
    public function geopos($member, ...$other_members)
    {
        return $this->connection->geopos($this->key, $member, ...$other_members);
    }

    /**
     * 返回某个位置特定半径范围内的成员
     * @access public
     * @param float $lng 经度
     * @param float $lat 纬度
     * @param float $radius 半径
     * @param string $unit 单位
     * @param array $options 其它参数
     * @return mixed
     */
    public function georadius($lng, $lat, $radius, $unit, array $options = [])
    {
        return $this->connection->georadius($this->key, $lng, $lat, $radius, $unit, $options);
    }

    /**
     * georadius的只读模式, 可以只在从服务器运行
     * @access public
     * @param float $lng 经度
     * @param float $lat 纬度
     * @param float $radius 半径
     * @param string $unit 单位
     * @param array $options 其它参数
     * @return mixed
     */
    public function georadius_ro($lng, $lat, $radius, $unit, array $options = [])
    {
        return $this->connection->georadius_ro($this->key, $lng, $lat, $radius, $unit, $options);
    }

    /**
     * 返回某个成员特定半径范围内的成员
     * @access public
     * @param float $member 成员
     * @param float $radius 半径
     * @param string $unit 单位
     * @param array $options 其它参数
     * @return mixed
     */
    public function georadiusbymember($member, $radius, $unit, array $options = [])
    {
        return $this->connection->georadiusbymember($this->key, $member, $radius, $unit, $options);
    }

    /**
     * georadiusbymember的只读模式, 可以只在从服务器运行
     * @access public
     * @param float $member 成员
     * @param float $radius 半径
     * @param string $unit 单位
     * @param array $options 其它参数
     * @return mixed
     */
    public function georadiusbymember_ro($member, $radius, $unit, array $options = [])
    {
        return $this->connection->georadiusbymember_ro($this->key, $member, $radius, $unit, $options);
    }

    /**
     * 按条件查询成员
     * @access public
     * @param array|string $position 参考点位置
     * @param array|int|float $shape 一个数字表示半径, 数组表示纵横距离
     * @param string $unit 单位
     * @param array $options 其它参数
     * @return array
     */
    public function geosearch($position, $shape, $unit, array $options = [])
    {
        return $this->connection->geosearch($this->key, $position, $shape, $unit, $options = []);
    }

    /**
     * 按条件查询成员，并将结果存储到新集合中
     * @access public
     * @param string $src 要查询的地理位置空间
     * @param array|string $position 参考点位置
     * @param array|int|float $shape 一个数字表示半径, 数组表示纵横距离
     * @param string $unit 单位
     * @param array $options 其它参数
     * @return array|int|false
     */
    public function geosearchstore($src, $position, $shape, $unit, array $options = [])
    {
        return $this->connection->geosearchstore($this->key, $src, $position, $shape, $unit, $options = []);
    }
}
