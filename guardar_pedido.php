<?php
require 'vendor/autoload.php';
require 'conn.php'; // Tu archivo de conexión a la base de datos

\Stripe\Stripe::setApiKey('sk_test_51RsiACAJJRFMxL6dn6loP1fIWMDX9js3QLU0xBxCeQCr0TxEmrRgpJK5BiuZm2lIzdvzNHscfuUZRwqiFA0Wc95Q00qW67N8p9');

if (!isset($_GET['session_id'])) {
    die('No se recibió el session_id');
}

$session_id = $_GET['session_id'];
try {
    $session = \Stripe\Checkout\Session::retrieve($session_id);
    $metadata = $session->metadata;
    $total = $session->amount_total / 100;

    // Obtener email y nombre del cliente
    $customer = \Stripe\Customer::retrieve($session->customer);
    $cliente_email = $customer->email;
    $cliente_nombre = $customer->name;

    // Recuperar el carrito desde POST (enviado desde success.html)
    $carrito = isset($_POST['carrito']) ? json_decode($_POST['carrito'], true) : [];
    $direccion_calle = isset($_POST['direccion_calle']) ? $_POST['direccion_calle'] : '';
    $direccion_numero = isset($_POST['direccion_numero']) ? $_POST['direccion_numero'] : '';
    $direccion_colonia = isset($_POST['direccion_colonia']) ? $_POST['direccion_colonia'] : '';
    $direccion_ciudad = isset($_POST['direccion_ciudad']) ? $_POST['direccion_ciudad'] : '';
    $direccion_estado = isset($_POST['direccion_estado']) ? $_POST['direccion_estado'] : '';
    $direccion_cp = isset($_POST['direccion_cp']) ? $_POST['direccion_cp'] : '';

    // Guardar pedido principal
    $stmt = $conn->prepare("
        INSERT INTO pedidos (
            fecha, total, cliente_nombre, cliente_email,
            direccion_calle, direccion_numero, direccion_colonia,
            direccion_ciudad, direccion_estado, direccion_cp
        ) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        'dssssssss',
        $total,
        $cliente_nombre,
        $cliente_email,
        $direccion_calle,
        $direccion_numero,
        $direccion_colonia,
        $direccion_ciudad,
        $direccion_estado,
        $direccion_cp
    );
    $stmt->execute();
    $pedido_id = $conn->insert_id;

    // Guardar productos del pedido
    foreach ($carrito as $item) {
        $stmt = $conn->prepare("
            INSERT INTO pedido_productos (
                pedido_id, producto_id, cantidad, precio_unitario
            ) VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param(
            'iiid',
            $pedido_id,
            $item['id'],
            $item['cantidad'],
            $item['precio']
        );
        $stmt->execute();
    }

    echo '<div style="font-family:Arial,sans-serif;background:#f6f6f6;text-align:center;padding:60px;">
      <div style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #0001;display:inline-block;padding:40px 60px;">
        <h1 style="color:#27ae60;">¡Gracias por tu compra!</h1>
        <p style="color:#333;font-size:1.2em;">Tu pedido fue guardado correctamente.<br>Pronto recibirás un correo de confirmación.</p>
        <a href="index.php" style="color:#27ae60;text-decoration:none;font-weight:bold;">Volver a la tienda</a>
      </div>
    </div>';
} catch (Exception $e) {
    echo 'Error al guardar el pedido: ' . $e->getMessage();
}
?>
