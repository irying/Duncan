#!/usr/bin/env php
<?php

namespace helloworld\php;

error_reporting(E_ALL);

//echo __DIR__; exit();
require_once __DIR__ . '/../../thrift/php/vendor/autoload.php';
require_once __DIR__ . '/../../thrift/php/vendor/apache/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';


///**
use Thrift\ClassLoader\ThriftClassLoader;

//$GEN_DIR = realpath(dirname(__FILE__).'/..').'/gen-php';
$GEN_DIR = __DIR__ . '/../thrift_code/gen-php';

$loader = new ThriftClassLoader();
//$loader->registerNamespace('Thrift', '/opt/thrift_php/lib');
//$loader->registerNamespace('Thrift', __DIR__ . '/../../lib/php/lib');
//$loader->registerDefinition('shared', $GEN_DIR);
$loader->registerDefinition('helloworld', $GEN_DIR);
$loader->register();



use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;
//**/


//$socket = new TSocket('localhost', 8090); 
$socket = new TSocket('172.19.0.16', 8090);
$transport = new TBufferedTransport($socket, 1024, 1024);
$protocol = new TBinaryProtocol($transport);
$client = new \helloworld\HelloWorldServiceClient($protocol);
print_r($client);

$transport->open();
$t = microtime(true);
for ($i = 0; $i < 10; $i++) {
    $client->sayHello("jimmyxx");
}
$t1 = microtime(true) - $t;
file_put_contents("test.txt", $t1 . "\n", FILE_APPEND);
$str = $client->sayHello("jimmyxx");
echo $str;

//$log = $client->getStruct(1);
//print "Log: $log->value\n";

$transport->close();

















