<?php

class HelloService
{
    public static function sayHello($name)
    {
        return 'hello ' . $name;
    }
}


$service = $_GET['service'];
$action = $_GET['action'];
$argv = file_get_contents("php://input");

if (!$service || !$action) {
    die();
}

if ($argv) {
    $argv = json_decode($argv, true);
}


$res = call_user_func_array([$service, $action], $argv);

echo json_encode($res);