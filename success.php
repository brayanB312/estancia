<?php
require 'vendor/autoload.php';
require 'conn.php';

\Stripe\Stripe::setApiKey('sk_test_51RsiACAJJRFMxL6dn6loP1fIWMDX9js3QLU0xBxCeQCr0TxEmrRgpJK5BiuZm2lIzdvzNHscfuUZRwqiFA0Wc95Q00qW67N8p9');

$session_id = $_GET['session_id'] ?? null;
$pedido_id = $_GET['pedido_id'] ?? null;

try {
    if (!$session_id || !$pedido_id) {
        throw new Exception('Parámetros inválidos');
    }

    // Verificar el pago con Stripe
    $session = \Stripe\Checkout\Session::retrieve($session_id);
    
    if ($session->payment_status !== 'paid') {
        throw new Exception('El pago no se completó');
    }

    // Actualizar pedido en la base de datos
    $stmt = $conn->prepare("
        UPDATE pedidos 
        SET estado_pedido = 'pagado', 
            stripe_payment_intent_id = ?,
            fecha_actualizacion = NOW()
        WHERE id = ?
    ");
    $stmt->execute([$session->payment_intent, $pedido_id]);

    // Limpiar carrito
    echo "<script>localStorage.removeItem('carrito');</script>";

    // Mostrar confirmación
    echo "<h1>¡Pago exitoso!</h1>";
    echo "<p>Número de pedido: #$pedido_id</p>";
    echo "<p>ID de transacción: {$session->payment_intent}</p>";
    echo "<a href='index.php' class='btn-primary'>Volver a la tienda</a>";

} catch (Exception $e) {
    echo "<h1>Error en el pedido</h1>";
    echo "<p>{$e->getMessage()}</p>";
    echo "<a href='carrito.php' class='btn-secondary'>Volver al carrito</a>";
}