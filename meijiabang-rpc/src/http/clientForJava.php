<?php

class clientForJava
{
    private $url;
    private $service;

    private $rpcConfig = [
//        "UserService" => "http://172.19.0.16:8081/server.php",
        "UserService" => "http://127.0.0.1:8081",
    ];

    /**
     * Client constructor.
     * @param $service
     */
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

        return file_get_contents($url, false, $context);
    }

}

$userService = new clientForJava('UserService');
var_export($userService->getUserInfo(10));