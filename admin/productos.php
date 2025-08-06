<?php
session_start();
require __DIR__ . '/../../conn.php'; // Ruta corregida

// Verificar admin
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php"); // Ruta corregida
    exit;
}

// Obtener productos
$productos = $conn->query("SELECT * FROM productos")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        .btn-edit {
            background-color: #f39c12;
            color: white;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../components/admin_navbar.php'; ?> <!-- Ruta corregida -->
    
    <div class="container">
        <h1>Gestión de Productos</h1>
        <a href="/estancia/admin/productos/agregar.php" class="btn btn-primary">➕ Nuevo Producto</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><img src="<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>"></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td>$<?= number_format($p['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($p['tipo']) ?></td>
                    <td>
                        <a href="/estancia/admin/productos/editar.php?id=<?= $p['id'] ?>" class="btn btn-edit">✏️ Editar</a>
                        <a href="/estancia/admin/productos/eliminar.php?id=<?= $p['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar este producto?')">❌ Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>