<?php
declare(strict_types=1);

/* INCLUDES */
require("CrudHandler.php");
header('Access-Control-Allow-Origin: http://localhost:3000');
try {
     $crudHandler = new CrudHandler();
     $rawJsonData = file_get_contents('php://input');
     $crudHandler->HandleRequest($rawJsonData, $_SERVER['REQUEST_METHOD']);
} catch (ErrorException $e) {
    //header('HTTP/1.1 401 Unauthorized', true, 401);
    print("Error: ". $e->getMessage() ." is either missing or wrong type...<br />\r\n" );
}
//$c = new Mosquitto\Client;
?>