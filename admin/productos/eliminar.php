<?php
require __DIR__ . '/../../conn.php';
require __DIR__ . '/../includes/auth.php';

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Verificar que el producto existe
$stmt = $conn->prepare("SELECT id FROM productos WHERE id = ?");
$stmt->execute([$id]);

if($stmt->fetch()){
    // Eliminar el producto
    $conn->prepare("DELETE FROM productos WHERE id = ?")->execute([$id]);
    header("Location: index.php?success=Producto+eliminado");
} else {
    header("Location: index.php?error=Producto+no+encontrado");
}
exit;