<?php
// public/index.php
declare(strict_types=1);

// 1. Cargar config
require __DIR__ . '/../config/config.php';

// 2. Autoload simple
spl_autoload_register(function($class){
    $bases = [
        __DIR__ . '/../core',
        __DIR__ . '/../app/Controllers',
        __DIR__ . '/../app/Models'
    ];
    foreach ($bases as $b) {
        $file = $b . '/' . $class . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

if (!is_dir(UPLOAD_DIR)) {
    @mkdir(UPLOAD_DIR, 0777, true);
}

$basePath = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');


$router = new Router($basePath);


$router->get('/',                     [MensajeController::class, 'index']);
$router->get('/mensajes',            [MensajeController::class, 'index']);
$router->get('/mensajes/create',     [MensajeController::class, 'create']);
$router->post('/mensajes/store',     [MensajeController::class, 'store']);
$router->get('/mensajes/show',       [MensajeController::class, 'show']);
$router->get('/mensajes/edit',       [MensajeController::class, 'edit']);
$router->post('/mensajes/update',    [MensajeController::class, 'update']);

$router->get('/mensajes/delete',     [MensajeController::class, 'destroy']);
$router->post('/mensajes/delete',    [MensajeController::class, 'destroy']);

// 7. Despachar
$router->dispatch();
