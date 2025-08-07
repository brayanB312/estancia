<?php
// obtener_pedido.php
require 'conn.php';
header('Content-Type: application/json');

$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : '';
if (!$session_id) {
    echo json_encode(['error' => 'Falta session_id']);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM pedidos WHERE stripe_session_id = ? LIMIT 1");
$stmt->execute([$session_id]);
$pedido = $stmt->fetch();

if ($pedido && isset($pedido['id'])) {
    echo json_encode(['pedido_id' => $pedido['id']]);
} else {
    echo json_encode(['error' => 'No encontrado']);
}
