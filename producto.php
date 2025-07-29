<?php

include 'components/navbar.php';
include 'components/footer.php';
include 'components/product_slider.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    require  'conn.php';

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
    <title><?php echo $nombre; ?></title>
    <link rel="stylesheet" href="styles/producto.css">
</head>
<body>

    <?php navbar(); ?>

    <section class="producto_section">
    <div class="producto_imagen">
        <img src="<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>">
    </div>
    <div class="producto_detalle">
        <h2><?php echo $nombre; ?></h2>
        <p class="tipo"><?php echo $tipo; ?></p>
        <span class="precio"><?php echo "$" . $precio ?></span>
        <p class="descripcion"><?php echo $descripcion; ?></p>
        <button class="btn_agregar agregar-carrito"
                data-id="<?php echo $id; ?>"
                data-nombre="<?php echo htmlspecialchars($nombre); ?>"
                data-precio="<?php echo $precio; ?>">
            Agregar al carrito
        </button>
    </div>
    </section>

    <div style="background-color: #EFEFEF; padding: 50px 0; width=100%; text-align: center; margin-top: 50px; border-bottom: 1px solid #EEEEEE; border-top: 1px solid #EEEEEE;">
        <h2>Productos similares:</h2>
    </div>

    <?php product_slider($tipo); ?>

    <?php footer(); ?>

    
</body>
</html>