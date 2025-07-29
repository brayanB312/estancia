<?php
require 'conn.php';
session_start();

header('Content-Type: application/json');

if (!isset($_POST['producto_id'])) {
    echo json_encode(['success' => false, 'message' => 'Producto no especificado']);
    exit;
}

$productoId = $_POST['producto_id'];
$usuarioId = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

try {
    $query = "SELECT * FROM carrito WHERE producto_id = ? AND (usuario_id = ? OR (usuario_id IS NULL AND ? IS NULL))";
    $stmt = $conn->prepare($query);
    $stmt->execute([$productoId, $usuarioId, $usuarioId]);
    $itemExistente = $stmt->fetch();

    if ($itemExistente) {
        $query = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$itemExistente['id']]);
    } else {
        $query = "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$usuarioId, $productoId]);
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()]);
}