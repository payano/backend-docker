<?php
//declare(strict_types=1);

print($_SERVER['REQUEST_METHOD']);
switch($_SERVER['REQUEST_METHOD']) {
    case "GET":
        break;
    case "POST":
        break;
    case "PUT":
        break;
        case "DELETE":
            break;
    default:
            break;
}
phpinfo();


$mysqli = new mysqli("db","backend","changeme","backend");
$c = new Mosquitto\Client;
?>