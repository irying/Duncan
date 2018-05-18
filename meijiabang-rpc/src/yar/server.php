<?php

class Server
{

    public function api($parameter = "", $option = "foo")
    {
        return $this->client_can_not_see($parameter);
    }


    public function doAdd($a = 0, $b = 0)
    {
        return $a + $b;
    }

    protected function client_can_not_see($name)
    {
        return "你好$name~";
    }
}

$service = new Yar_Server(new Server());
$service->handle();

