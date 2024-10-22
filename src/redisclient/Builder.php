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

namespace think\redisclient;

/**
 * Redis键名构建器类
 */
class Builder
{
    use concern\builder\Bitmaps;
    use concern\builder\Generic;
    use concern\builder\Geospatial;
    use concern\builder\Hashes;
    use concern\builder\HyperLogLog;
    use concern\builder\Lists;
    use concern\builder\Sets;
    use concern\builder\SortedSets;
    use concern\builder\Strings;
    use concern\builder\Transactions;

    /**
     * 当前连接对象
     * @var Connection
     */
    protected $connection;

    /**
     * 原始键名
     * @var string|array
     */
    protected $originKey;

    /**
     * 当前键名
     * @var string|array
     */
    protected $key;
    
    /**
     * 当前键名变量
     * @var array
     */
    protected $vars = [];

    /**
     * 架构函数
     * @access public
     * @param Connection $connection 连接对象
     */
    public function __construct(Connection $connection)
    {
        // 连接对象
        $this->connection = $connection;
    }

    /**
     * 获取当前的Connection对象
     * @access public
     * @param bool $master 是否在主服务器读操作
     * @return \Redis|\Predis\Client
     */
    public function getConnection($master = false)
    {
        return $this->connection->getConnection($master);
    }

    /**
     * 获取配置参数
     * @access public
     * @param string $name 参数名称
     * @return mixed
     */
    public function getConfig($name = '')
    {
        return $this->connection->getConfig($name);
    }

    /**
     * 指定当前键名
     * @access public
     * @param string|array $key 键名
     * @param array $vars 变量
     * @return $this
     */
    public function key($key, array $vars = [])
    {
        // 原始键名
        $this->originKey = $key;
        // 当前键名变量
        $this->vars = $vars;
        // 解析当前键名
        $this->key = $this->parseKey();

        return $this;
    }

    /**
     * 获取当前键名
     * @access public
     * @return string|array
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * 指定变量
     * @access public
     * @param string|array $field 变量名
     * @param string $value 变量值
     * @return $this
     */
    public function where($field, $value = '')
    {
        // 如果当前变量已经是索引数组则不可更改键名
        if (key($this->vars) === 0) {
            return $this;
        }

        // 要处理的变量数组
        $vars = [];
        // 如果传入数组
        if(is_array($field)){
            foreach($field as $key => $val){
                if(is_string($val) || is_numeric($val)){
                    $vars[$key] = $val;
                }
            }
            
        }
        // 传入字符串或者数组
        elseif(is_string($field) || is_numeric($field)){
            $vars[$field] = $value;
        }
        // 不合法类型
        else{
            return $this;
        }

        // 合并变量
        $this->vars = array_merge($this->vars, $vars);
        // 解析当前键名
        $this->key = $this->parseKey();

        return $this;
    }

    /**
     * 解析键名
     * @access protected
     * @return string
     */
    protected function parseKey() {
        // 获取当前原始键名
        $originKey = $this->originKey;
        // 如果键名为空
        if(empty($originKey)) {
            return '';
		}
        // 如果变量为空或者不是数组
        if(empty($this->vars) || !is_array($this->vars)){
            return $originKey;
        }
        // 如果当前变量已经是关联数组
        if (key($this->vars) !== 0) {
            return $this->varsMatch($originKey, $this->vars);
        }

        // 键名数组
        $key = [];
        // 如果是索引数组
        foreach($this->vars as $var){
            // 数组
            if(is_array($var)){
                $key[] = $this->varsMatch($originKey, $var);
            }
        }
        
        return $key;
    }

    /**
     * 变量匹配
     * @access protected
     * @param string|array $key 键名
     * @param array $vars 变量值
     * @return string
     */
    protected function varsMatch($key, array $vars) {
        // 遍历变量并替换
		foreach ($vars as $k => $v) {
            // 如果变量值是字符串或者数字
            if(is_string($v) || is_numeric($v)){
                $key = str_replace('<'.$k.'>', $v, $key);
            }
		}
        // 没有匹配到变量的则替换为空
        $key = preg_replace('/<\w+>/', '', $key);

        return $key;
    }
}
