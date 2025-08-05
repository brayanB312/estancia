<?php
require __DIR__ . '/../../conn.php';
require __DIR__ . '/../includes/auth.php';

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch();

if(!$producto){
    header("Location: index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = trim($_POST['nombre']);
    $precio = (float)$_POST['precio'];
    $descripcion = trim($_POST['descripcion']);
    $tipo = $_POST['tipo'];
    $imagen = trim($_POST['imagen']);

    $stmt = $conn->prepare("UPDATE productos SET nombre=?, precio=?, descripcion=?, tipo=?, imagen=? WHERE id=?");
    $stmt->execute([$nombre, $precio, $descripcion, $tipo, $imagen, $id]);
    
    header("Location: index.php?success=Producto+actualizado");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>

</head>
<body>
    <?php include __DIR__ . '/../components/admin_navbar.php'; ?>
    
    <div class="container">
        <h1>Editar Producto</h1>
        
        <form method="POST" class="product-form">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="descripcion" rows="4"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" id="tipo" name="tipo" class="form-control" 
                    value="<?= htmlspecialchars($producto['tipo']) ?>" required>
                <small class="form-text">Ejemplo: "telefono", "calzado", "accesorio"</small>
            </div>
            
            <div class="form-group">
                <label>URL de la imagen:</label>
                <input type="url" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>" required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="index.php" class="btn btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>