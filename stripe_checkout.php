<?php
require 'vendor/autoload.php';

header('Content-Type: application/json');

// Configuración de Stripe
\Stripe\Stripe::setApiKey('sk_test_51RsiACAJJRFMxL6dn6loP1fIWMDX9js3QLU0xBxCeQCr0TxEmrRgpJK5BiuZm2lIzdvzNHscfuUZRwqiFA0Wc95Q00qW67N8p9');

// Conexión a la base de datos
$db = new mysqli('localhost', 'root', '', 'tienda');
if ($db->connect_error) {
    die(json_encode(['error' => 'Error de conexión a la base de datos']));
}

// Obtener datos del POST

$carrito = isset($_POST['carrito']) ? json_decode($_POST['carrito'], true) : [];
$cliente_nombre = isset($_POST['cliente_nombre']) ? $_POST['cliente_nombre'] : '';
$cliente_email = isset($_POST['cliente_email']) ? $_POST['cliente_email'] : '';
$direccion_calle = isset($_POST['direccion_calle']) ? $_POST['direccion_calle'] : '';
$direccion_numero = isset($_POST['direccion_numero']) ? $_POST['direccion_numero'] : '';
$direccion_colonia = isset($_POST['direccion_colonia']) ? $_POST['direccion_colonia'] : '';
$direccion_ciudad = isset($_POST['direccion_ciudad']) ? $_POST['direccion_ciudad'] : '';
$direccion_estado = isset($_POST['direccion_estado']) ? $_POST['direccion_estado'] : '';
$direccion_cp = isset($_POST['direccion_cp']) ? $_POST['direccion_cp'] : '';

// Calcular total del carrito
$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
$total += $total * 0.10; // Agregar 10% de impuestos

try {
    // 1. Crear el pedido en la base de datos
    $stmt = $db->prepare("INSERT INTO pedidos (total, cliente_nombre, cliente_email, direccion_calle, direccion_numero, direccion_colonia, direccion_ciudad, direccion_estado, direccion_cp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("dssssssss", $total, $cliente_nombre, $cliente_email, $direccion_calle, $direccion_numero, $direccion_colonia, $direccion_ciudad, $direccion_estado, $direccion_cp);
    $stmt->execute();
    $pedido_id = $db->insert_id;
    $stmt->close();

    // 2. Insertar los productos del pedido
    $stmt = $db->prepare("INSERT INTO pedido_productos (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
    foreach ($carrito as $item) {
        $stmt->bind_param(
            "iiid",
            $pedido_id,
            $item['id'],
            $item['cantidad'],
            $item['precio']
        );
        $stmt->execute();
    }
    $stmt->close();

    // 3. Crear los line items para Stripe
    $line_items = [];
    foreach ($carrito as $item) {
        $line_items[] = [
            'price_data' => [
                'currency' => 'mxn',
                'product_data' => [
                    'name' => $item['nombre'],
                    'images' => [isset($item['imagen']) ? $item['imagen'] : ''],
                ],
                'unit_amount' => intval($item['precio'] * 100),
            ],
            'quantity' => $item['cantidad'],
        ];
    }

    // 4. Crear la sesión de Stripe
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => 'http://localhost/estancia/success_final.html?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/estancia/cancel.html',
        'metadata' => [
            'pedido_id' => $pedido_id,
            'cliente_nombre' => $cliente_nombre,
            'cliente_email' => $cliente_email,
            'direccion_calle' => $direccion_calle,
            'direccion_numero' => $direccion_numero,
            'direccion_colonia' => $direccion_colonia,
            'direccion_ciudad' => $direccion_ciudad,
            'direccion_estado' => $direccion_estado,
            'direccion_cp' => $direccion_cp
        ]
    ]);

    echo json_encode(['id' => $session->id, 'pedido_id' => $pedido_id]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}