<?php
class SwooleClient
{
    private $url;
    private $service;

    private $rpcConfig = [
        "SwooleHelloService" => "http://127.0.0.1:9504",
    ];

    public function __construct($service)
    {
        if (array_key_exists($service, $this->rpcConfig)) {
            $this->url = $this->rpcConfig[$service];
            $this->service = $service;
        }
    }

    public function __call($action, $arguments)
    {
        $content = json_encode($arguments);
        $options['http'] = [
            'timeout' => 5,
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $content,
        ];

        $context = stream_context_create($options);

        $get = [
            'service' => $this->service,
            'action' => $action,
        ];

        $url = $this->url . "?" . http_build_query($get);
        echo $url . "\n";

        $res = file_get_contents($url, false, $context);

        return json_decode($res, true);
    }
}

define("CLIENT_IP", "127.0.0.1");
define("CLIENT_PORT", 9503);
$http = new swoole_http_server(CLIENT_IP, CLIENT_PORT);

$http->on("start", function ($server) {
    echo "http server is started at http://" . CLIENT_IP. ':' . CLIENT_PORT . "\n";
});

$http->on("request", function ($request, $response) {
    $helloService = new SwooleClient('SwooleHelloService');
    $res = $helloService->sayHello('world');
    $response->header("Content-Type", "text/plain");
    $response->end(var_export($res, true));
});

$http->start();