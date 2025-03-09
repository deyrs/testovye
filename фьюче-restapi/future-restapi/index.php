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
if (preg_match('#^ /api/tasks/? $#xi', $requestUri)) {
    $ctrl = new \App\Controllers\Task();

    if ($requestMethod === 'GET') {
        $ctrl->findAll();
    } elseif ($requestMethod === 'POST') {
        $jsonBody = json_decode(file_get_contents("php://input"));
        $ctrl->create($jsonBody);
    }
} elseif (preg_match('#^ /api/tasks(\? ([[:alpha:]+ = [\S]+) (& ([[:alpha:]]+ = [\S]+) )* ) $#xi', $requestUri)) {
    $ctrl = new \App\Controllers\Task();

    $ctrl->findAllWithParams($_GET);
} elseif (preg_match('#^ /api/tasks/ %7B([[:digit:]]+)%7D $#xi', $requestUri, $matches)) {
    $ctrl = new \App\Controllers\Task();

    $id = $matches[1];
    if ($requestMethod === 'GET') {
        $ctrl->findOne($id);
    } elseif ($requestMethod === 'PUT') {
        $jsonBody = json_decode(file_get_contents("php://input"));
        $ctrl->update($id, $jsonBody);
    } elseif ($requestMethod === 'DELETE') {
        $ctrl->delete($id);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Bad Request"]);
}