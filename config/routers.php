<?php
declare(strict_types=1);

use Alura\MVC\Controller\DeleteVideoController;
use Alura\MVC\Controller\EditVideoController;
use Alura\MVC\Controller\NewVideoController;
use Alura\MVC\Controller\VideoFormController;
use Alura\MVC\Controller\VideoListController;

return [
    'GET|/' => VideoListController::class,
    'GET|/novo-video' => VideoFormController::class,
    'POST|/novo-video' => NewVideoController::class,
    'GET|/editar-video' => VideoFormController::class,
    'POST|/editar-video' => EditVideoController::class,
    'GET|/remover-video' => DeleteVideoController::class,
];