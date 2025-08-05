<?php 
function product_slider_sin_botones($tipo){
?>
<style>
* {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', sans-serif;
}

.slider-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  padding: 30px 200px;
}

.card-container {
  display: flex;
  overflow-x: auto;
  gap: 10px;
  padding: 10px;
  border: none;
  scroll-behavior: smooth;
}

.card {
  min-width: 300px;
  max-width: 400px;
  background: #FFF;
  padding: 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-radius: 8px;
}

.card img {
  width: 100%;
  aspect-ratio: 1/1;
  object-fit: contain;
  margin-bottom: 10px;
}

.card a {
    color: #000;
}

.card_title{
  font-size: 1.1rem;
  color: #000000;
}

.buy-button {
  cursor: pointer;
  background-color: #000;
  padding: 12px;
  border: none;
  font-weight: bold;
  border-radius: 8px;
  color: #FFF;
  transition: background-color 0.3s ease;
  width: 100%;
}

.buy-button:hover {
  background-color: #222222;
}

.price{
  font-weight: bold;
  color: #222222;
  font-size: 1rem;
  margin-top: 12px;
  margin-bottom: 20px;
}

.slider_title{
  text-align: center;
  margin-top: 100px;
}

@media (max-width: 1024px){
  .slider-wrapper {
    padding: 30px 100px;
  }
}

@media (max-width: 600px){
  .slider-wrapper {
    padding: 30px 0px;
  }
}
</style>

<div class='slider_title'>
    <h2><?php echo ucfirst($tipo); ?></h2>
</div>

<div class="slider-wrapper">
  <div class="card-container">
    <?php 
    require 'conn.php';

    $query = "SELECT * FROM productos WHERE tipo = :tipo";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->execute();

    $productos = $stmt->fetchAll();

    foreach ($productos as $p) {
        $id = $p['id'];
        $nombre = htmlspecialchars($p['nombre']);
        $precio = number_format($p['precio'], 2);
        $imagen = htmlspecialchars($p['imagen']);
        
        echo "
        <div class='card'>
            <a href='producto.php?id=$id'>
                <img src='$imagen' alt='$nombre'>
                <h3 class='card_title'>$nombre</h3>
            </a>
            <p class='price'>\$$precio</p>
            <button class='buy-button agregar-carrito' 
                    data-id='$id'
                    data-nombre='$nombre'
                    data-precio='$precio'>
                Agregar al carrito
            </button>
        </div>";
    }
    ?>
  </div>
</div>
<?php
}
?>