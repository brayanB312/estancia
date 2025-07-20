<?php
header('Content-Type: application/json');
// Ruta relativa correcta para conexion.php (están en la misma carpeta)
include __DIR__ . '/conexion.php';

$ids = $_GET['ids'] ?? '';
$idsArray = array_filter(explode(',', $ids));

if (empty($idsArray)) {
    http_response_code(400);
    echo json_encode(["error" => "IDs no proporcionados"]);
    exit;
}

// Consulta segura con prepared statements
$placeholders = implode(',', array_fill(0, count($idsArray), '?'));
$query = "SELECT id, nombre, precio FROM productos WHERE id IN ($placeholders)";
$stmt = $conexion->prepare($query);
$tipos = str_repeat('i', count($idsArray));
$stmt->bind_param($tipos, ...$idsArray);
$stmt->execute();
$result = $stmt->get_result();

$productos = [];
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);
?>