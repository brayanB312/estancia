<?php
include 'conexion.php';

$pedido_id = $_GET['id'] ?? 0;

// Obtener datos del pedido
$stmt = $conexion->prepare("SELECT * FROM pedidos WHERE id = ?");
$stmt->bind_param("i", $pedido_id);
$stmt->execute();
$pedido = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu compra</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>pedido listo #<?= htmlspecialchars($pedido_id) ?> confirmado</h1>
        <p>Total: <strong>$<?= number_format($pedido['total'] ?? 0, 2) ?></strong></p>
        <p>Recibirás un correo en <em><?= htmlspecialchars($pedido['cliente_email'] ?? '') ?></em> con los detalles.</p>
        <a href="index.php" class="btn">Volver a la tienda</a>
    </div>
</body>
</html>