<?php

namespace helloworld\httpServer;

error_reporting(E_ALL);

require_once __DIR__ . '/../../thrift/php/vendor/autoload.php';
require_once __DIR__ . '/../../thrift/php/vendor/apache/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';


use helloworld\HelloWorldServiceIf;
use Services\Test\HelloWorldProcessor;
use Thrift\ClassLoader\ThriftClassLoader;

$genDir = __DIR__ . '/../thrift_code/gen-php';
$loader = new ThriftClassLoader();
$loader->registerDefinition('Services', $genDir);
$loader->register();

if (php_sapi_name() == 'cli') {
    ini_set("display_errors", "stderr");
}

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use Thrift\Transport\TBufferedTransport;

class helloHandler implements HelloWorldServiceIf
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

$handler = new helloHandler();
$processor = new HelloWorldProcessor($handler);

$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);

$transport->open();
$processor->process($protocol, $protocol);
$transport->close();

