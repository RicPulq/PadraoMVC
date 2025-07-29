<?php

declare(strict_types=1);

use Alura\MVC\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404Controller,
    NewVideoController,
    VideoFormController,
    VideoListController,
};
use Alura\MVC\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dsn = "pgsql:host=localhost;port=5432;dbname=db-aluraplay";
$pdo = new PDO($dsn, 'admin', 'admin');
$videoRepository = new VideoRepository($pdo);

$routers = require_once __DIR__ . '/../config/routers.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routers)){
        $controllerClass = $routers["$key"];
        $controller = new $controllerClass($videoRepository);
}else {
        $controller = new Error404Controller();
}

$controller->processaRequisicao();