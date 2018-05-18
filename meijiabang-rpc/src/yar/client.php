<?php
$client = new Yar_Client("http://172.19.0.16/yar/server.php");
$result = $client->api("parameter");
echo $result;
echo "<br />";
echo $client->doAdd(10, 20);
