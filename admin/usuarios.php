<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/includes/auth.php';

$usuarios = $conn->query("SELECT id, nombre, correo, rol FROM usuarios ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        .container { max-width: 900px; margin: 30px auto; background: #fff; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.08); }
        h1 { color: #333; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f9f9f9; }
        tr:hover { background: #f1f7ff; }
        .back { display: inline-block; margin-bottom: 15px; color: #3498db; text-decoration: none; }
        .back:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/components/admin_navbar.php'; ?>
    <div class="container">
        <a href="dashboard.php" class="back">&larr; Volver al dashboard</a>
        <h1>Usuarios registrados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                    <td><?= htmlspecialchars($usuario['rol']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
