<?php
session_start();

// Configuración de rutas base (todo en este archivo)
$base_url = '/estanciafrt/admin';
$base_path = __DIR__ . '/../..'; // Ajusta según tu estructura

require $base_path . '/conn.php';

// Verificar admin
if(!isset($_SESSION['admin'])) {
    header("Location: $base_url/login.php");
    exit;
}

// Obtener productos
$productos = $conn->query("SELECT * FROM productos")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Productos</title>
    <base href="<?= $base_url ?>/">
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
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
            color: white;
        }
        .btn-primary {
            background-color: #3498db;
        }
        .btn-edit {
            background-color: #f39c12;
        }
        .btn-delete {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <!-- Navbar integrado directamente -->
    <nav style="background:#2c3e50; color:white; padding:15px;">
        <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between;">
            <a href="<?= $base_url ?>/dashboard.php" style="color:white; text-decoration:none;">Panel Admin</a>
            <div>
                <?php if(isset($_SESSION['user_name'])): ?>
                    <span style="margin-right:20px;">Hola, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <?php endif; ?>
                <a href="<?= $base_url ?>/logout.php" style="color:white; text-decoration:none;">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Gestión de Productos</h1>
        <a href="<?= $base_url ?>/productos/agregar.php" class="btn btn-primary">➕ Nuevo Producto</a>
        
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
                        <a href="<?= $base_url ?>/productos/editar.php?id=<?= $p['id'] ?>" class="btn btn-edit">✏️ Editar</a>
                        <a href="<?= $base_url ?>/productos/eliminar.php?id=<?= $p['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Eliminar este producto?')">❌ Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>