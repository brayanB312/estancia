<?php
require 'conn.php';
session_start();

header('Content-Type: application/json');

$usuarioId = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

try {
    $query = "SELECT SUM(cantidad) as total FROM carrito WHERE usuario_id = ? OR (usuario_id IS NULL AND ? IS NULL)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$usuarioId, $usuarioId]);
    $resultado = $stmt->fetch();

    echo json_encode(['cantidad' => $resultado['total'] ?? 0]);
} catch (PDOException $e) {
    echo json_encode(['cantidad' => 0]);
}