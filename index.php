<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas Slider</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css?v=1.6">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="slider-wrapper">
  <button class="slider-btn left" id="btn-left">&lt;</button>

  <div class="card-container" id="slider">
    <?php
    $images = ["assets/1.webp","assets/2.webp","assets/3.webp","assets/4.webp","assets/5.webp","assets/6.webp","assets/7.webp","assets/8.webp","assets/9.webp","assets/10.webp","assets/11.webp","assets/12.webp","assets/13.webp"];
    foreach ($images as $i) {
      echo "
      <div class='card'>
        <img src='$i'>
        <h1>Producto</h1>
        <p>Descripcion</p>
        <button class='buy-button btn btn-primary'>Comprar</button>
      </div>
      ";
    }
    ?>
  </div>

  <button class="slider-btn right" id="btn-right">&gt;</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>
const slider = document.getElementById('slider');
document.getElementById('btn-left').addEventListener('click', () => {
  slider.scrollBy({ left: -300, behavior: 'smooth' });
});
document.getElementById('btn-right').addEventListener('click', () => {
  slider.scrollBy({ left: 300, behavior: 'smooth' });
});
</script>

</body>
</html>
