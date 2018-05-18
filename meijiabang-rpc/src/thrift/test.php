<?php
error_reporting(E_ALL);

require_once __DIR__ . '/php/vendor/autoload.php';
require_once __DIR__ . '/php/vendor/apache/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';

use Services\Test\HelloWorldClient;
use Thrift\ClassLoader\ThriftClassLoader;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

$genDir = __DIR__ . '/php/gen-php';
$loader = new ThriftClassLoader();
$loader->registerDefinition('Services', $genDir);
$loader->register();



try {
    if (array_search('--http', $argv)) {
        $socket = new THttpClient('172.19.0.16', 80, '/thrift/httpServer.php');
    } else {
        $socket = new TSocket('172.19.0.16', 9090);
    }
    $transport = new TBufferedTransport($socket, 1024, 1024);
    $protocol = new TBinaryProtocol($transport);
    $client = new HelloWorldClient($protocol);

    $transport->open();
    $t = microtime(true);
    for ($i = 0; $i < 100; $i++) {
        $client->sayHello('World');
    }
    echo microtime(true) - $t;
    file_put_contents("test.txt", microtime(true) - $t, FILE_APPEND);
    $transport->close();

} catch (TException $tx) {
    print 'TException: ' . $tx->getMessage() . "\n";
}

