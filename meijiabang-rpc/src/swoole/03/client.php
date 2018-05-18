<?php
$clients = array();
$request = [
    'service' => 'TcpHelloService',
    'action' => 'sayHello'
];
$msg = json_encode($request);
$packedMsg = pack('N', strlen($msg)) . $msg . "\n";
$t = microtime(true);
for ($i = 0; $i < 100; $i++) {
    $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC); //同步阻塞
    $ret = $client->connect('127.0.0.1', 9501, 0.5, 0);
    if (!$ret) {
        echo "Connect Server fail.errCode=" . $client->errCode;
    } else {
        $client->send($packedMsg);
        $clients[$client->sock] = $client;
    }
}

while (!empty($clients)) {
    $write = $error = array();
    $read = array_values($clients);
    $n = swoole_client_select($read, $write, $error, 0.6);
    if ($n > 0) {
        foreach ($read as $index => $c) {
            echo "Recv #{$c->sock}: " . $c->recv() . "\n";
            unset($clients[$c->sock]);
        }
    }
}
$t1 = microtime(true) - $t;
file_put_contents("test.txt", $t1 . "\n", FILE_APPEND);