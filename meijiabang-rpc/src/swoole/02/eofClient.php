<?php

class EofClient
{
    private $client;

    public function __construct()
    {
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
    }

    public function connect()
    {
        if (!$this->client->connect("172.19.0.16", 9501, 1)) {
            echo "Error: \n";
        }
        $request = [
            'service' => 'EofHelloService',
            'action' => 'sayHello'
        ];
        $msg = json_encode($request) . "\r\n";
        $t = microtime(true);
        for ($i = 0; $i < 10; $i++) {
            $this->client->send($msg);
            $this->client->recv();
        }
        $t1 = microtime(true) - $t;
        file_put_contents("test.txt", $t1 . "\n", FILE_APPEND);
    }
}
$client = new EofClient();
$client->connect();