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
    <?php include __DIR__ . '/../components/admin_navbar.php'; ?>
    <div class="form-container">
        <h1 class="page-title">Editar Producto</h1>
        <form method="POST" class="product-form">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="descripcion" rows="4"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" id="tipo" name="tipo" 
                    value="<?= htmlspecialchars($producto['tipo']) ?>" required>
                <small>Ejemplo: "telefono", "calzado", "accesorio"</small>
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