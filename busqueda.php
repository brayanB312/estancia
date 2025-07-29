<?php
include 'components/navbar.php';
include 'components/footer.php'; 
require 'conn.php';

$termino = isset($_GET['q']) ? trim($_GET['q']) : '';

$resultados = [];

if ($termino !== '') {
    $sql = "SELECT * FROM productos 
            WHERE nombre LIKE :busqueda 
               OR tipo LIKE :busqueda 
               OR descripcion LIKE :busqueda";

    $stmt = $conn->prepare($sql);
    $busqueda = "%" . $termino . "%";
    $stmt->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
    $stmt->execute();
    $resultados = $stmt->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar: <?php echo htmlspecialchars($termino); ?></title>
    <link rel="stylesheet" href="styles/busqueda.css?v=1.2">
</head>
<body>

<?php navbar(); ?>

<section class="resultados_busqueda">
    <?php if (empty($resultados)): ?>
        <div class="no_resultados">
            <p>No se encontraron productos relacionados con "<?php echo htmlspecialchars($termino); ?>".</p>
        </div>
    <?php else: ?>
        <div class="grid_resultados">
            <h2 style="margin-bottom: 60px;" >Resultados para "<?php echo htmlspecialchars($termino); ?>"</h2>
            <?php foreach ($resultados as $producto): ?>
                <a href="<?php echo 'producto.php?id=' . $producto['id'] ?>">
                <div class="result_container">
                    <div>
                        <img class="prod_img" src="<?php echo $producto['imagen'];?>" alt="<?php echo $producto['nombre'];?>">
                    </div>
                    <div class="div2">
                        <div class="text_div">
                            <h3><?php echo $producto['nombre'];?></h3>
                            <p><?php echo $producto['tipo'];?></p>
                            <span><?php echo "$" . $producto['precio'];?></span>
                        </div>
                        <div>
                            <button class="buy agregar-carrito" 
                                    data-id="<?php echo $producto['id']; ?>"
                                    data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                    data-precio="<?php echo $producto['precio']; ?>">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php footer() ?>
<script src="/estanciafrt/carrito.js"></script>
</body>
</html>
