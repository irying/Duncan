<?php
namespace HelloWorld\socketServer;

error_reporting(E_ALL);

define('SERVICE_DIR', __DIR__ . '/php');
require_once SERVICE_DIR . '/vendor/autoload.php';
require_once SERVICE_DIR . '/vendor/apache/thrift/lib/php/lib/Thrift/ClassLoader/ThriftClassLoader.php';

use Services\Test\HelloWorldIf;
use Services\Test\HelloWorldProcessor;
use Thrift\ClassLoader\ThriftClassLoader;
use Thrift\Factory\TBinaryProtocolFactory;
use Thrift\Factory\TTransportFactory;
use Thrift\Server\TServerSocket;
use Thrift\Server\TForkingServer;

$genDir = SERVICE_DIR . '/gen-php';
//注册以自动加载类，目录记得改为自己实际的目录，如果不想用自动加载类也可以将TestService.php和Types.php直接包含进来
$loader = new ThriftClassLoader();
$loader->registerDefinition('Services', $genDir);
$loader->register();

if (php_sapi_name() == 'cli') {
    ini_set("display_errors", "stderr");
}

class HelloWorldHandler implements HelloWorldIf
{
    /**
     * @param string $name
     * @return string
     */
    public function sayHello($name)
    {
        return "hello from socket: " . $name;
    }
}

$serverTransport = new TServerSocket("0.0.0.0", 9090);
$clientTransport = new TTransportFactory();
$binaryProtocol = new TBinaryProtocolFactory();
$handler = new HelloWorldHandler();
$processor = new HelloWorldProcessor($handler);
$server = new TForkingServer(
    $processor,
    $serverTransport,
    $clientTransport,
    $clientTransport,
    $binaryProtocol,
    $binaryProtocol
);

$server->serve();