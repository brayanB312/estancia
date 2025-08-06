<?php
require 'vendor/autoload.php';

header('Content-Type: application/json');

// Tu clave secreta de Stripe (pruebas)
\Stripe\Stripe::setApiKey('sk_test_51RsiACAJJRFMxL6dn6loP1fIWMDX9js3QLU0xBxCeQCr0TxEmrRgpJK5BiuZm2lIzdvzNHscfuUZRwqiFA0Wc95Q00qW67N8p9');



$carrito = isset($_POST['carrito']) ? json_decode($_POST['carrito'], true) : [];
$direccion_calle = isset($_POST['direccion_calle']) ? $_POST['direccion_calle'] : '';
$direccion_numero = isset($_POST['direccion_numero']) ? $_POST['direccion_numero'] : '';
$direccion_colonia = isset($_POST['direccion_colonia']) ? $_POST['direccion_colonia'] : '';
$direccion_ciudad = isset($_POST['direccion_ciudad']) ? $_POST['direccion_ciudad'] : '';
$direccion_estado = isset($_POST['direccion_estado']) ? $_POST['direccion_estado'] : '';
$direccion_cp = isset($_POST['direccion_cp']) ? $_POST['direccion_cp'] : '';

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

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => 'http://localhost/estancia/success.html',
        'cancel_url' => 'http://localhost/estancia/cancel.html',
        'metadata' => [
            'direccion_calle' => $direccion_calle,
            'direccion_numero' => $direccion_numero,
            'direccion_colonia' => $direccion_colonia,
            'direccion_ciudad' => $direccion_ciudad,
            'direccion_estado' => $direccion_estado,
            'direccion_cp' => $direccion_cp
        ]
    ]);
    echo json_encode(['id' => $session->id]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}