<?php
include 'components/navbar.php';
include 'components/footer.php';
include 'components/product_slider.php';
require 'conn.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda</title>
    <link rel="stylesheet" href="styles/index.css?v=1.6">

</head>
<body>

  <?php navbar(); ?>

  <section class="main_section">
    <div class="main1">
      <h1>Las mejores ofertas</h1>
      <a href="#feat"><button>Comprar</button></a>
    </div>
    <div class="main2">
      <img src="assets/images/hero.png" alt="Hero">
    </div>
  </section>

  <section class="featured_section">
    <div class="productos_destacados" id="feat">
      <?php 
        
        $query = "SELECT * FROM productos LIMIT 8";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $productos = $stmt->fetchAll();

        foreach($productos as $producto) {
          echo "
          <a href='producto.php?id={$producto['id']}'>
            <div class='card'>
              <div class='card_image_wrapper'>
                <img src='{$producto['imagen']}' alt='{$producto['nombre']}' class='featured-image'>
              </div>
              <div class='card_content'>
                <h3>{$producto['nombre']}</h3>
                <p>{$producto['descripcion']}</p>
                <span>$".number_format($producto['precio'], 2)."</span>
                <button class='buy-button agregar-carrito'
                        data-id='{$producto['id']}'
                        data-nombre='".htmlspecialchars($producto['nombre'])."'
                        data-precio='{$producto['precio']}'
                        data-imagen='".htmlspecialchars($producto['imagen'])."'>  
                    Agregar al carrito    
                </button>
              </div>
            </div>
          </a>
          ";
        }
      ?>
    </div>
  </section>

  <?php
  
  $query = "SELECT DISTINCT tipo FROM productos ORDER BY tipo";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $tipos = $stmt->fetchAll(PDO::FETCH_COLUMN);

  
  foreach ($tipos as $tipo) {
      echo "<section class='slider_section'>";
      
      product_slider($tipo);
      echo "</section>";
  }
  ?>

  <?php footer(); ?>
  <script src="carrito.js"></script>
</body>
</html>