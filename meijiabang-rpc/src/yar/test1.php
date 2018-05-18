<?php
$client = new Yar_Client("http://172.19.0.16/yar/server.php");
$t = microtime(true);
for ($i = 0; $i < 100; $i++) {
    $client->api("parameter");
}
echo microtime(true) - $t;
