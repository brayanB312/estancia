<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas Slider</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css?v=1.6">
  <script src="https://cdn.tailwindcss.com"></script>
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

<div class="slider-wrapper transform transition duration-300 hover:scale-105 cursor-pointer">
  <button class="slider-btn left" id="btn-left">&lt;</button>

  <div class="card-container" id="slider">
    <div class="d-flex overflow-auto gap-3 px-4" id="slider" style="scroll-behavior:smooth;">
  <?php include 'app/obtener_productos.php'; ?>
</div>

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
