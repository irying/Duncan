<?php
function callback($retval, $callinfo) {
    var_dump($retval);
}
$server = "http://172.19.0.16/yar/server.php";
Yar_Concurrent_Client::call($server, "api", array("parameters"), "callback");
Yar_Concurrent_Client::call($server, "api", array("parameters"), "callback");
Yar_Concurrent_Client::call($server, "api", array("parameters"), "callback");
Yar_Concurrent_Client::call($server, "api", array("parameters"), "callback");
Yar_Concurrent_Client::loop(); //send
