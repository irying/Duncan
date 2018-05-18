<?php
class UserService
{
    public static function getUserInfo($uid)
    {
        // 假设以下内容从数据库取出
        return [
            'id'       => $uid,
            'username' => 'mengkang',
        ];
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