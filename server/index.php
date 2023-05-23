<?php

declare(strict_types=1);

spl_autoload_register(function ($class) {
	require __DIR__ . "/src/$class.php";
});

set_exception_handler("errorhandler::handleException");
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if($parts[1] != "server" || $parts[2] != "data"){
	http_response_code(404);
	exit;
}

$id = $parts[3] ?? null;

$database = new Database("localhost", "car data", "root", "");

$gateway = new databaseGateway($database);

$controller = new Controller($gateway);
$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);