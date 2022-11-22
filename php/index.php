<?php
//declare(strict_types=1);

phpinfo();

$mysqli = new mysqli("127.0.0.1","my_user","my_password","my_db");
$c = new Mosquitto\Client;
?>