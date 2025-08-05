<?php
session_start();

// Configuración de rutas base
$base_url = '/estanciafrt/admin';
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
    <link rel="stylesheet" href="../../assets/css/style.css">
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