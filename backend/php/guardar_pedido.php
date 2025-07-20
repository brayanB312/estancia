<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json'); // Debe ir antes de cualquier output

include '../conexion.php'; // Verifica que la ruta sea correcta

// Debug: Registra la entrada
file_put_contents('debug_input.log', file_get_contents('php://input'));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}


$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE || !isset($data['carrito'])) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    exit;
}

$carrito = $data['carrito'];
$cliente_nombre = trim($data['cliente_nombre'] ?? '');
$cliente_email = filter_var($data['cliente_email'] ?? '', FILTER_VALIDATE_EMAIL);


if (empty($carrito)) {
    echo json_encode(['success' => false, 'message' => 'Carrito vacío']);
    exit;
}


$conexion->begin_transaction();

try {
    // validacion de localstorage con base de datos
    $total = 0;
    foreach ($carrito as $item) {
        if (!isset($item['id'], $item['precio'], $item['cantidad'])) {
            throw new Exception('Datos de producto incompletos');
        }

        // checa que el precio en ambos esta igual
        $stmt = $conexion->prepare("SELECT precio FROM productos WHERE id = ?");
        $stmt->bind_param("i", $item['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception('Producto no encontrado');
        }

        $precio_real = $result->fetch_assoc()['precio'];
        if ($precio_real != $item['precio']) {
            throw new Exception('Precio modificado para el producto ID: ' . $item['id']);
        }

        $total += $precio_real * $item['cantidad'];
    }

    
    $stmt = $conexion->prepare("INSERT INTO pedidos (total, cliente_nombre, cliente_email) VALUES (?, ?, ?)");
    $stmt->bind_param("dss", $total, $cliente_nombre, $cliente_email);
    
    if (!$stmt->execute()) {
        throw new Exception('Error al guardar el pedido');
    }

    $pedido_id = $conexion->insert_id;
    $stmt->close();

    foreach ($carrito as $item) {
        $stmt = $conexion->prepare("INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
        $precio_real = floatval($item['precio']);
        $stmt->bind_param("iiid", $pedido_id, $item['id'], $item['cantidad'], $precio_real);
        
        if (!$stmt->execute()) {
            throw new Exception('Error al guardar detalles del pedido');
        }
        $stmt->close();
    }

    $conexion->commit();

    echo json_encode([
        'success' => true,
        'pedido_id' => $pedido_id,
        'total' => number_format($total, 2)
    ]);

} catch (Exception $e) {

    $conexion->rollback();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>