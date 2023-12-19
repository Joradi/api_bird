<?php

require_once "./controller.php";
require_once "./config/database.php";

$database = new Database(
    getenv("DATABASE_HOST"),
    getenv("DATABASE_USER"),
    getenv("DATABASE_PASS"),
    getenv("DATABASE_NAME"),
    getenv("DATABASE_PORT")
);

$params = [
    "request" => $_REQUEST,
    "server" => $_SERVER,
    "session" => $_SESSION
];

$method = strtolower($_SERVER["REQUEST_METHOD"]);

$controller = new Controller($database->connect());

$out = "";

if ($method == "get") {
    $out = $controller->list($params);
}

if ($method == "post") {
    $out = $controller->create($params);
}

if ($method == "update") {
    $out = $controller->update($params, $id);
}

if ($method == "delete") {
    $out = $controller->delete($params);
}

echo $out;
