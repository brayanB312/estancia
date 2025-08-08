<?php 
function product_slider($tipo){
?>
<style>
* {
  margin: 0;
  padding: 0;
  font-family: 'Inter', sans-serif;
}

.slider-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  padding: 30px 20px;
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
  box-sizing: border-box;
}

.card-container {
  display: flex;
  overflow-x: auto;
  gap: 20px;
  padding: 10px 0;
  border: none;
  scroll-behavior: smooth;
  width: 100%;
  box-sizing: border-box;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.card-container::-webkit-scrollbar {
  display: none;
}

.card {
  min-width: 280px;
  max-width: 300px;
  background: #FFF;
  padding: 20px;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-radius: 12px;
  box-sizing: border-box;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  flex-shrink: 0;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Wrapper uniforme para imágenes del slider */
.card_image_wrapper {
  width: 100%;
  height: 280px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  border-radius: 8px;
  background: #f8f8f8;
  margin-bottom: 15px;
  padding: 10px;
}

.card img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: center;
  border-radius: 8px;
  transition: transform 0.3s ease;
}

.card a {
  color: #000;
  text-decoration: none;
}

.card_title {
  font-size: 1.1rem;
  color: #000000;
  margin: 10px 0;
  font-weight: 600;
  line-height: 1.3;
}

.slider-btn {
  background: rgba(0, 0, 0, 0.7);
  color: white;
  border: none;
  width: 45px;
  height: 45px;
  cursor: pointer;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
  border-radius: 50%;
  font-size: 1.2rem;
  transition: all 0.3s ease;
}

.buy-button {
  cursor: pointer;
  background-color: #000;
  padding: 12px;
  border: none;
  font-weight: bold;
  border-radius: 8px;
  color: #FFF;
  transition: all 0.3s ease;
  width: 100%;
  font-size: 0.95rem;
  margin-top: auto;
}

.buy-button:hover {
  background-color: #333;
  transform: translateY(-2px);
}

.price {
  font-weight: bold;
  color: #222222;
  font-size: 1.1rem;
  margin: 15px 0 20px 0;
}

.slider-btn.left {
  left: 10px;
}

.slider-btn.right {
  right: 10px;
}

.slider-btn:hover {
  background: rgba(0, 0, 0, 0.9);
  transform: translateY(-50%) scale(1.1);
}

.slider_title {
  text-align: center;
  margin: 80px 0 40px 0;
}

.slider_title h2 {
  font-size: clamp(1.8rem, 4vw, 2.5rem);
  color: #333;
}

/* RESPONSIVE DESIGN */
@media (max-width: 1200px) {
  .slider-wrapper {
    padding: 30px 15px;
  }
  
  .card {
    min-width: 260px;
    max-width: 280px;
  }
  
  .card_image_wrapper {
    height: 260px;
  }
}

@media (max-width: 900px) {
  .slider-wrapper {
    padding: 20px 10px;
  }
  
  .card {
    min-width: 240px;
    max-width: 260px;
    padding: 15px;
  }
  
  .card_image_wrapper {
    height: 240px;
  }
  
  .slider-btn {
    width: 40px;
    height: 40px;
    font-size: 1rem;
  }
}

@media (max-width: 600px) {
  .slider-btn.left,
  .slider-btn.right {
    display: none;
  }
  
  .slider-wrapper {
    padding: 15px 5px;
  }
  
  .card-container {
    gap: 15px;
    padding: 5px 0;
  }
  
  .card {
    min-width: 300px;
    max-width: 320px;
    padding: 15px;
  }
  
  .card_image_wrapper {
    height: 260px;
    padding: 12px;
  }
  
  .slider_title {
    margin: 60px 0 30px 0;
  }
}

@media (max-width: 400px) {
  .card {
    min-width: 280px;
    max-width: 300px;
    padding: 12px;
  }
  
  .card_image_wrapper {
    height: 240px;
    padding: 10px;
  }
  
  .card_title {
    font-size: 1rem;
  }
  
  .buy-button {
    padding: 10px;
    font-size: 0.9rem;
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
      slider.scrollBy({ left: -320, behavior: 'smooth' });
    });

    btnRight?.addEventListener('click', () => {
      slider.scrollBy({ left: 320, behavior: 'smooth' });
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
        // Truncar descripción a 100 caracteres si es muy larga
        $desc_corta = mb_strlen($descripcion) > 100 ? mb_substr($descripcion, 0, 100) . '...' : $descripcion;
        echo "
        <div class='card'>
            <a href='producto.php?id=$id'>
                <div class='card_image_wrapper'>
                    <img src='$imagen' alt='$nombre'>
                </div>
                <div class='card_content'>
                    <h3>$nombre</h3>
                    <p>$desc_corta</p>
                    <span>\$$precio</span>
                    <button class='buy-button agregar-carrito' 
                            data-id='$id'
                            data-nombre='$nombre'
                            data-precio='{$p['precio']}'
                            data-imagen='$imagen'>
                        Agregar al carrito
                    </button>
                </div>
            </a>
        </div>";
    }
    ?>
  </div>

  <button class="slider-btn right">&gt;</button>
</div>
<?php
}
?>
