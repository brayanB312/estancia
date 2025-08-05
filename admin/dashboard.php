<?php
require __DIR__ . '/../conn.php';
require __DIR__ . '/includes/auth.php';

$productCount = $conn->query("SELECT COUNT(*) FROM productos")->fetchColumn();
$userCount = $conn->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .stats-grid {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .stat-card {
            flex: 1;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
        .stat-card h3 {
            margin-top: 0;
            color: #555;
        }
        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .stat-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        .stat-card a:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/components/admin_navbar.php'; ?>
    
    <div class="container">
        <h1>Dashboard</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Productos</h3>
                <p><?= $productCount ?></p>
                <a href="productos/">Gestionar</a>
            </div>
            <div class="stat-card">
                <h3>Usuarios</h3>
                <p><?= $userCount ?></p>
                <a href="#">Ver todos</a>
            </div>
        </div>
    </div>
</body>
</html>