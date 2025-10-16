<?php
header('Content-Type: application/json');

// 1. Solo permitir solicitudes POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

// 2. Leer el contenido JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// 3. Validar el ID
if (!isset($data['id']) || !is_numeric($data['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit;
}

$id = (int)$data['id'];

// 4. Conexión a la base de datos
require_once __DIR__ . '/../config/db.php'; // Ajusta esta ruta según tu estructura

// 5. Eliminar el mensaje
$stmt = $db->prepare("DELETE FROM mensajes WHERE id = ?");
$resultado = $stmt->execute([$id]);

if ($resultado) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No se pudo eliminar el mensaje']);
}
