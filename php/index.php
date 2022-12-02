<?php
declare(strict_types=1);

/* INCLUDES */
require("CrudHandler.php");

/*
    Create 	POST 	/api/movie
    Read 	GET 	/api/movie/{id}
    Update 	PUT 	/api/movie
    Delete 	DELETE 	/api/movie/{id}
 */


 //header('HTTP/1.1 401 Unauthorized', true, 401);

 
 try {
    $crudHandler = new CrudHandler();
    $rawJsonData = file_get_contents('php://input');
    $ret = $crudHandler->HandleRequest($rawJsonData, $_SERVER['REQUEST_METHOD']);
} catch (ErrorException $e) {
    //header('HTTP/1.1 401 Unauthorized', true, 401);
    print("Error: ". $e->getMessage() ." is either missing or wrong type...<br />\r\n" );
}

$mysqli = new mysqli("db","backend","changeme","backend");
$c = new Mosquitto\Client;
?>