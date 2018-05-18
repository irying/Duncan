<?php

$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->set([
    'open_length_check'     => 1,       // 开启协议解析
    'package_length_type'   => 'N',     // 长度字段的类型
    'package_length_offset' => 0,       //第N个字节是包长度的值
    'package_body_offset'   => 4,       //第N个字节开始计算长度
    'package_max_length'    => 8192,  //协议最大长度
//    'socket_buffer_size'     => 1024*1024*2, //2M缓存区
]);
$client->on("connect", function(swoole_client $cli) {
    $request = [
        'service' => 'TcpHelloService',
        'action' => 'sayHello'
    ];
    $msg = json_encode($request) . "\r\n";
    $packedMsg = pack('N', strlen($msg)). $msg;
    $t = microtime(true);
    $cli->send($packedMsg);
    for ($i = 0; $i < 10; $i++) {
        $cli->send($packedMsg);
    }
    $t1 = microtime(true) - $t;
    file_put_contents("second.txt", $t1 . "\n", FILE_APPEND);
});
$client->on("receive", function(swoole_client $cli, $data){
    echo $data;
    $info = unpack('N', $data);
    $len = $info[1];
    $body = substr($data, - $len);
    echo "server received data: {$body}\n";

});
$client->on("error", function(swoole_client $cli){
    echo "error\n";
});
$client->on("close", function(swoole_client $cli){
    echo "Connection close\n";
});
$client->connect('127.0.0.1', 9501);