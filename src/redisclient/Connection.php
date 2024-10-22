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

use think\facade\Log;

/**
 * 连接器类
 */
class Connection
{
    use concern\connection\Bitmaps;
    use concern\connection\Generic;
    use concern\connection\Geospatial;
    use concern\connection\Hashes;
    use concern\connection\HyperLogLog;
    use concern\connection\Lists;
    use concern\connection\Sets;
    use concern\connection\SortedSets;
    use concern\connection\Strings;
    use concern\connection\Transactions;

    /**
     * 错误信息
     * @var string
     */
    protected $error = '';

    /**
     * 连接ID 支持多个连接
     * @var array
     */
    protected $links = [];

    /**
     * 当前连接ID
     * @var object
     */
    protected $linkID;

    /**
     * 当前读连接ID
     * @var object
     */
    protected $linkRead;

    /**
     * 当前写连接ID
     * @var object
     */
    protected $linkWrite;

    /**
     * 查询开始时间
     * @var float
     */
    protected $queryStartTime;

    /**
     * 是否读取主库
     * @var bool
     */
    protected $readMaster = false;

    /**
     * 重连次数
     * @var int
     */
    protected $reConnectTimes = 0;

    /**
     * 服务器断线标识字符
     * @var array
     */
    protected $breakMatchStr = [
        'Redis server went away',
        'Connection timed out',
        'NOAUTH Authentication required.',
    ];

    /**
     * 连接参数配置
     * @var array
     */
    protected $config = [
        // 主机
        'host'              => '127.0.0.1',
        // 端口
        'port'              => 6379,
        // 密码
        'password'          => '',
        // 数据库索引
        'select'            => 0,
        // 超时时间
        'timeout'           => 0,
        // 是否是长链接
        'persistent'        => false,
        // 部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        'deploy'            => 0,
        // 读写是否分离 主从式有效
        'rw_separate'       => false,
        // 读写分离后 主服务器数量
        'master_num'        => 1,
        // 指定从服务器序号
        'slave_no'          => '',
        // 有数据写入后自动读取主服务器
        'read_master'       => false,
        // 是否需要断线重连
        'break_reconnect'   => false,
        // 断线标识字符串
        'break_match_str'   => [],
        // 键名构建器类
        'builder'           => '',
    ];

    /**
     * 架构方法
     * @access public
     * @param array $config 配置参数
     */
    public function __construct(array $config = [])
    {
        if (!empty($config)) {
            $this->config = array_merge($this->config, $config);
        }
    }

    /**
     * 指定键名
     * @param string $key 键名
     * @param array $vars 变量
     * @return Builder
     */
    public function key($key, array $vars = [])
    {
        return $this->newBuilder()->key($key, $vars);
    }

    /**
     * 创建执行器
     * @access protected
     * @return Builder
     */
    protected function newBuilder()
    {
        $class = $this->getBuilderClass();

        /** @var Builder $builder */
        $builder = new $class($this);

        return $builder;
    }

    /**
     * 获取当前连接器类对应的Builder类
     * @access protected
     * @return string
     */
    protected function getBuilderClass()
    {
        return $this->getConfig('builder') ?: Builder::class;
    }

    /**
     * 获取配置参数
     * @access public
     * @param string $name 配置名称
     * @return mixed
     */
    public function getConfig($name = '')
    {
        if ('' === $name) {
            return $this->config;
        }

        return isset($this->config[$name]) ? $this->config[$name] : null;
    }

    /**
     * 连接方法
     * @access protected
     * @param array $config 连接参数
     * @param integer $linkNum 连接序号
     * @param array|bool $autoConnection 是否自动连接主服务器（用于分布式）
     * @return mixed
     * @throws \Exception
     */
    protected function connect(array $config = [], $linkNum = 0, $autoConnection = false)
    {
        // 存在连接
        if (isset($this->links[$linkNum])) {
            return $this->links[$linkNum];
        }

        if (empty($config)) {
            $config = $this->config;
        } else {
            $config = array_merge($this->config, $config);
        }

        // 配置了断线标识字符串
        if (!empty($config['break_match_str'])) {
            $this->breakMatchStr = array_merge($this->breakMatchStr, (array) $config['break_match_str']);
        }

        try {
            // 创建连接
            $this->links[$linkNum] = $this->createConnection($config);
            // 返回
            return $this->links[$linkNum];
        } catch (\Exception $e) {
            if ($autoConnection) {
                // 记录日志
                Log::log('redis', $e->getMessage());
                // 自动连接到下一个服务器
                return $this->connect($autoConnection, $linkNum);
            }
            // 抛出异常
            throw $e;
        }
    }

    /**
     * 创建连接实例
     * @param array $config
     * @return \Redis|\Predis\Client
     */
    protected function createConnection(array $config)
    {
        // 已安装redis扩展
        if (extension_loaded('redis')) {
            $handler = new \Redis;
            // 长链接
            if ($config['persistent']) {
                $handler->pconnect($config['host'], (int) $config['port'], (int) $config['timeout'], 'persistent_id_' . $config['select']);
            } else {
                $handler->connect($config['host'], (int) $config['port'], (int) $config['timeout']);
            }

            if ('' != $config['password']) {
                $handler->auth($config['password']);
            }
        }
        // 存在predis依赖
        elseif (class_exists('\Predis\Client')) {
            $params = [];
            foreach ($config as $key => $val) {
                if (in_array($key, ['aggregate', 'cluster', 'connections', 'exceptions', 'prefix', 'profile', 'replication', 'parameters'])) {
                    $params[$key] = $val;
                    unset($config[$key]);
                }
            }

            if ('' == $config['password']) {
                unset($config['password']);
            }

            $handler = new \Predis\Client($config, $params);

        }
        else {
            throw new \BadFunctionCallException('not support: redis');
        }

        if (0 != $config['select']) {
            $handler->select((int) $config['select']);
        }
        // 返回
        return $handler;
    }

    /**
     * 获取连接对象实例
     * @access public
     * @param bool $master 是否在主服务器读操作
     * @throws \Exception
     * @return mixed
     */
    public function getConnection($master = false)
    {
        try {
            // 初始化链接
            $this->initConnect($this->readMaster ?: $master);
            // 查询开始时间
            $this->queryStartTime = microtime(true);
            // 检测链接是否可用
            $this->linkID->ping($master);
            // 重置重新链接次数
            $this->reConnectTimes = 0;

            // 如果指定在主服务器写入数据后自动读取主服务器
            if ($master && !empty($this->config['deploy']) && !empty($this->config['read_master'])) {
                $this->readMaster = true;
            }

            // 返回连接对象
            return $this->linkID;
            
        } catch (\Exception $e) {
            // 如果重连次数小于4且属于断开状态
            if ($this->reConnectTimes < 4 && $this->isBreak($e)) {
                ++$this->reConnectTimes;
                return $this->close()->getConnection($master);
            }
            throw $e;
        }
    }

    /**
     * 初始化连接
     * @access protected
     * @param boolean $master 是否主服务器
     * @return void
     */
    protected function initConnect($master = true)
    {
        // 如果是分布式
        if (!empty($this->config['deploy'])) {
            // 指定连接主服务器
            if ($master) {
                if (!$this->linkWrite) {
                    $this->linkWrite = $this->multiConnect(true);
                }

                $this->linkID = $this->linkWrite;
            }
            else {
                if (!$this->linkRead) {
                    $this->linkRead = $this->multiConnect(false);
                }

                $this->linkID = $this->linkRead;
            }
        }
        // 集中式
        elseif (!$this->linkID) {
            // 默认单服务器
            $this->linkID = $this->connect();
        }
    }

    /**
     * 连接分布式服务器
     * @access protected
     * @param boolean $master 主服务器
     * @return mixed
     */
    protected function multiConnect($master = false)
    {
        $config = [];

        // 分布式配置解析
        foreach (['host', 'port', 'password', 'select', 'timeout'] as $name) {
            $config[$name] = explode(',', (string) $this->config[$name]);
        }

        // 主服务器序号
        $m = floor(mt_rand(0, $this->config['master_num'] - 1));

        // 主从式采用读写分离
        if ($this->config['rw_separate']) {
            // 主服务器写入
            if ($master){
                $r = $m;
            }
            // 指定服务器读
            elseif (is_numeric($this->config['slave_no'])) {
                $r = $this->config['slave_no'];
            }
            // 读操作连接从服务器 每次随机连接的服务器
            else {
                $r = floor(mt_rand($this->config['master_num'], count($config['host']) - 1));
            }
        } else {
            // 读写操作不区分服务器 每次随机连接的服务器
            $r = floor(mt_rand(0, count($config['host']) - 1));
        }
        // 是否自动连接主服务器
        $connectionMaster = false;

        if ($m != $r) {
            $connectionMaster = [];
            foreach (['host', 'port', 'password', 'select', 'timeout'] as $name) {
                $connectionMaster[$name] = isset($config[$name][$m]) ? $config[$name][$m] : $config[$name][0];
            }
        }

        $connectionConfig = [];

        foreach (['host', 'port', 'password', 'select', 'timeout'] as $name) {
            $connectionConfig[$name] = isset($config[$name][$r]) ? $config[$name][$r] : $config[$name][0];
        }

        return $this->connect($connectionConfig, $r, $r == $m ? false : $connectionMaster);
    }

    /**
     * 是否断线
     * @access protected
     * @param \Exception $e 异常对象
     * @return bool
     */
    protected function isBreak($e)
    {
        if (!$this->config['break_reconnect']) {
            return false;
        }

        $error = $e->getMessage();

        foreach ($this->breakMatchStr as $msg) {
            if (false !== stripos($error, $msg)) {
                return true;
            }
        }

        return false;
    }

    /**
     * 关闭连接（或者重新连接）
     * @access public
     * @return $this
     */
    public function close()
    {
        $this->linkID = null;
        $this->linkWrite = null;
        $this->linkRead = null;
        $this->links = [];

        return $this;
    }

    /**
     * 析构方法
     * @access public
     */
    public function __destruct()
    {
        // 关闭连接
        $this->close();
    }
}
