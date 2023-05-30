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

return [
    // 默认连接, 默认为连接配置里面的localhost
    'default' => 'localhost',
    // 连接配置
    'connections' => [
        // 本机连接参数
        'localhost' => [
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
        ],
        // 其它
        'other' => [
            // 主机
            'host' => '192.168.0.2',
            // 端口
            'port' => 6379,
            // 密码
            'password' => 'XXXXXX',
            // 数据库索引
            'select' => 0,
            // 超时时间
            'timeout' => 1
        ],
    ]
];
