<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

require_once __DIR__ . '/App/autoload.php';

// Получение URI и метода запроса
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Обработка роута
if (preg_match('/^\/api\/tasks\/?(\?([^&=]+=[^&]*)(?:&([^&=]+=[^&]*))*)?$/', $requestUri)) {
    $ctrl = new \App\Controllers\Task();

    if (empty($_GET)) {
        if ($requestMethod === 'GET') {
            $ctrl->findAll();
        } elseif ($requestMethod === 'POST') {
            $jsonBody = json_decode(file_get_contents("php://input"));
            $ctrl->create($jsonBody);
        }
    } else {
        $ctrl->findAllWithParams($_GET);
    }
} elseif (preg_match('/^\/api\/tasks\/%7B(\d+)%7D\/?$/', $requestUri, $matches)) {
    $ctrl = new \App\Controllers\Task();

    if ($requestMethod === 'GET') {
        $ctrl->findOne($matches[1]);
    } elseif ($requestMethod === 'PUT') {
        $jsonBody = json_decode(file_get_contents("php://input"));
        $ctrl->update($matches[1], $jsonBody);
    } elseif ($requestMethod === 'DELETE') {
        $ctrl->delete($matches[1]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Что-то пошло не так"]);
}