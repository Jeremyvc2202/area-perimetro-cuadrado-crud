<?php
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}


$data = json_decode(file_get_contents('php://input'), true);


if (!isset($data['id']) || !is_numeric($data['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit;
}

$id = (int)$data['id'];


require_once __DIR__ . '/../config/db.php';


$stmt = $db->prepare("DELETE FROM cuadrado WHERE id = ?");
$resultado = $stmt->execute([$id]);

if ($resultado) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No se pudo eliminar el registro']);
}
