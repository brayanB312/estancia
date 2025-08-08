<?php
session_start();
include 'components/navbar.php';
include 'components/footer.php';
include 'components/product_slider_sin_botones.php'; 

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    require 'conn.php';

    $query = "SELECT * FROM productos WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $producto = $stmt->fetch();

    if($producto){
        $nombre = $producto['nombre'];
        $precio = $producto['precio'];
        $descripcion = $producto['descripcion'];
        $imagen = $producto['imagen'];
        $tipo = $producto['tipo'];
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nombre); ?></title>
    <link rel="stylesheet" href="styles/producto.css?v=1.2">
</head>
<body>
    <?php navbar(); ?>

    <section class="producto_section">
        <div class="producto_imagen">
            <img src="<?php echo htmlspecialchars($imagen); ?>" alt="<?php echo htmlspecialchars($nombre); ?>">
        </div>
        <div class="producto_detalle">
            <h2><?php echo htmlspecialchars($nombre); ?></h2>
            <p class="tipo"><?php echo htmlspecialchars($tipo); ?></p>
            <span class="precio"><?php echo "$" . number_format($precio, 2); ?></span>
            <p class="descripcion"><?php echo htmlspecialchars($descripcion); ?></p>
            <button class="btn_agregar agregar-carrito"
                    data-id="<?php echo $id; ?>"
                    data-nombre="<?php echo htmlspecialchars($nombre); ?>"
                    data-precio="<?php echo $precio; ?>"
                    data-imagen="<?php echo htmlspecialchars($imagen); ?>">
                Agregar al carrito
            </button>
        </div>
    </section>

    <div class="seccion_similares">
        <h2>Productos similares:</h2>
    </div>

    <?php product_slider_sin_botones($tipo);  ?>

    <?php footer(); ?>
    <script src="carrito.js"></script>
</body>
</html>