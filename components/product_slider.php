<?php 
function product_slider($tipo){
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

.slider-btn {
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  width: 40px;
  height: 40px;
  cursor: pointer;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
  border-radius: 50%;
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

.slider-btn.left {
  left: 0;
  margin-left: 10px;
}

.slider-btn.right {
  right: 0;
  margin-right: 10px;
}

.slider-btn:hover {
  background: rgba(0, 0, 0, 0.8);
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
  .slider-btn.left,
  .slider-btn.right {
    display: none;
  }

  .slider-wrapper {
    padding: 30px 0px;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const sliders = document.querySelectorAll('.slider-wrapper');

  sliders.forEach(wrapper => {
    const slider = wrapper.querySelector('.card-container');
    const btnLeft = wrapper.querySelector('.slider-btn.left');
    const btnRight = wrapper.querySelector('.slider-btn.right');

    btnLeft?.addEventListener('click', () => {
      slider.scrollBy({ left: -400, behavior: 'smooth' });
    });

    btnRight?.addEventListener('click', () => {
      slider.scrollBy({ left: 400, behavior: 'smooth' });
    });
  });
});

</script>

<div class='slider_title'>
    <h2><?php echo $tipo;?></h2>
</div>

<div class="slider-wrapper">
  <button class="slider-btn left">&lt;</button>

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
        $descripcion = isset($p['descripcion']) ? htmlspecialchars($p['descripcion']) : '';
        
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
                    data-precio='$precio'
                    data-imagen='$imagen'>
                Agregar al carrito
            </button>
        </div>";
    }
    ?>
  </div>

  <button class="slider-btn right">&gt;</button>
</div>
<?php
}
?>
