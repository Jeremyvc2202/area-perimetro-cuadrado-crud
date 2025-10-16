<?php
// public/index.php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
spl_autoload_register(function($class){
    foreach ([__DIR__.'/../core', __DIR__.'/../app/Controllers', __DIR__.'/../app/Models'] as $b) {
        $f = $b . '/' . $class . '.php'; if (file_exists($f)) { require $f; return; }
    }
});
if (!is_dir(UPLOAD_DIR)) { @mkdir(UPLOAD_DIR, 0777, true); }
// public/index.php (después del autoload y antes de definir rutas)
$basePath = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
$router = new Router($basePath);

//$router = new Router();
$router->get('/', [MensajeController::class, 'index']);
$router->get('/mensajes', [MensajeController::class, 'index']);
$router->get('/mensajes/create', [MensajeController::class, 'create']);
$router->post('/mensajes/store', [MensajeController::class, 'store']);
$router->get('/mensajes/show', [MensajeController::class, 'show']);
$router->get('/mensajes/edit', [MensajeController::class, 'edit']);
$router->post('/mensajes/update', [MensajeController::class, 'update']);
$router->post('/mensajes/delete', [MensajeController::class, 'destroy']);
$router->dispatch();
