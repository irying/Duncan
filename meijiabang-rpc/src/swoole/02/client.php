<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);
// 开启固定包头协议检测
$client->set([
    'open_length_check'     => 1,       // 开启协议解析
    'package_length_type'   => 'N',     // 长度字段的类型
    'package_length_offset' => 0,       //第N个字节是包长度的值
    'package_body_offset'   => 4,       //第N个字节开始计算长度
    'package_max_length'    => 8192,  //协议最大长度
    'open_eof_check' => true,
    'package_eof' => "\r\n",
    'open_eof_split' => true,
]);
$request = [
    'service' => 'TcpHelloService',
    'action' => 'sayHello'
];
$msg = json_encode($request) . "\r\n";
$packedMsg = pack('N', strlen($msg)). $msg;
//$packedMsg = pack('N', strlen($msg)). $msg;
//$client->connect('172.19.0.16', '9501', 0.5);
if( !$client->connect("127.0.0.1", 9501 , -1) ) {
    echo "Error: \n";
} else {
    $t = microtime(true);
    for ($i = 0; $i < 10; $i++) {
        $client->send($packedMsg);
        $client->recv();
    }
    $t1 = microtime(true) - $t;
    file_put_contents("test.txt", $t1 . "\n", FILE_APPEND);
//    $client->send($packedMsg);
//    $client->recv();
//    $t1 = microtime(true) - $t;
//    file_put_contents("test.txt", $t1 . "\n", FILE_APPEND);
//    $client->send($packedMsg);
//    $response = $client->recv();
//    $body = substr($response, 4);
//    var_dump(json_decode($body, true));
    $client->close();
}


