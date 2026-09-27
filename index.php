<?php
// index.php
require_once __DIR__ . '/controllers/UserController.php';

$controller = new UserController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'crear':
        $controller->crear();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'guardar':
        $controller->guardar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}