<?php
session_start();

// Configuración de rutas base
$base_url = '/estancia/admin';
$base_path = __DIR__ . '/../..';

require $base_path . '/conn.php';

// Verificar admin
if(!isset($_SESSION['admin'])) {
    header("Location: $base_url/login.php");
    exit;
}

// Procesar formulario
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = (float)($_POST['precio'] ?? 0);
    $descripcion = trim($_POST['descripcion'] ?? '');
    $tipo = $_POST['tipo'] ?? '';
    $imagen = trim($_POST['imagen'] ?? '');

    // Validación básica
    if(!empty($nombre) && $precio > 0 && !empty($tipo) && !empty($imagen)) {
        $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, descripcion, tipo, imagen) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $precio, $descripcion, $tipo, $imagen]);
        
        header("Location: index.php?success=1");
        exit;
    } else {
        $error = "Todos los campos son requeridos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Producto</title>
    <base href="<?= $base_url ?>/">

    <style>
    body {
      background: #f8f8f8;
      font-family: 'Inter', Arial, sans-serif;
      color: #222;
    }
    .form-container {
      max-width: 500px;
      margin: 40px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 16px #0001;
      padding: 32px 28px 24px 28px;
    }
    h1, .page-title {
      font-size: 1.7rem;
      font-weight: 800;
      margin-bottom: 24px;
      text-align: center;
    }
    .form-group {
      margin-bottom: 18px;
    }
    label {
      display: block;
      font-weight: 600;
      margin-bottom: 7px;
      color: #333;
    }
    input[type="text"], input[type="number"], input[type="url"], textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ddd;
      border-radius: 7px;
      font-size: 1rem;
      background: #fafafa;
      transition: border-color 0.2s;
    }
    input:focus, textarea:focus {
      outline: none;
      border-color: #222;
    }
    textarea {
      min-height: 70px;
      resize: vertical;
    }
    .form-actions {
      display: flex;
      gap: 10px;
      margin-top: 18px;
    }
    .btn-primary {
      background: #111;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 13px 0;
      font-weight: 700;
      font-size: 1.05rem;
      cursor: pointer;
      flex: 1;
      transition: background 0.2s, transform 0.2s;
    }
    .btn-primary:hover {
      background: #333;
      transform: translateY(-2px);
    }
    .btn-cancel {
      background: #eee;
      color: #333;
      border: none;
      border-radius: 8px;
      padding: 13px 0;
      font-weight: 700;
      font-size: 1.05rem;
      cursor: pointer;
      flex: 1;
      text-align: center;
      text-decoration: none;
      transition: background 0.2s;
    }
    .btn-cancel:hover {
      background: #ddd;
    }
    small {
      color: #888;
      font-size: 0.95em;
    }
    </style>
</head>
<body>
    <?php include '../components/admin_navbar.php'; ?>

    <div class="form-container">
        <h1 class="page-title">Agregar Nuevo Producto</h1>
        <?php if(!empty($error)): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" id="precio" name="precio" class="form-control" step="0.01" min="0" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" id="tipo" name="tipo" class="form-control" required>
                <small class="form-text">Ejemplo: "telefono", "calzado", "accesorio"</small>
            </div>
            
            <div class="form-group">
                <label for="imagen" class="form-label">URL de la Imagen</label>
                <input type="url" id="imagen" name="imagen" class="form-control" required>
                <small class="form-text">Ejemplo: https://ejemplo.com/imagen.jpg</small>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>