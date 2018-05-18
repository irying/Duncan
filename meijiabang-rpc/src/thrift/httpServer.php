<?php

namespace HelloWorld\httpServer;

error_reporting(E_ALL);

define('SERVICE_ROOT', __DIR__ . '/php');
require_once SERVICE_ROOT . '/vendor/autoload.php';
require_once SERVICE_ROOT . '/vendor/apache/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';

use Services\Test\HelloWorldIf;
use Services\Test\HelloWorldProcessor;
use Thrift\ClassLoader\ThriftClassLoader;

$loader = new ThriftClassLoader();
$loader->registerDefinition('Service', SERVICE_ROOT . '/gen-php');
$loader->register();

if (php_sapi_name() == 'cli') {
    ini_set("display_errors", "stderr");
}

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;

class HelloWorldHandler implements HelloWorldIf
{
    /**
     * @param string $name
     * @return string
     */
    public function sayHello($name)
    {
        return "hello from http: " . $name;
    }
}

header('Content-Type', 'application/x-thrift');
if (php_sapi_name() == 'cli') {
    echo "\r\n";
}

$handler = new HelloWorldHandler();
$processor = new HelloWorldProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();

