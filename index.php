<?php
// Configuración inicial
$page_name = "Balatro";
$title = "Balatro";
$logo_url = "assets/logo.webp";

// Incluir navbar con su función
include 'components/navbar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_name; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (ya incluido en navbar.php) -->
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="fronted/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

    <!-- Navbar -->
    <?php navbar($logo_url, $title); ?>
    
    <!-- Contenido principal (con margen superior para el navbar fijo) -->
    <main class="main-content" style="margin-top: 75px;">
        
        <!-- Sección de navegación secundaria -->
        <section class="secondary-navigation">
            <div class="container">
                <div class="d-flex justify-content-center py-3">
                    <a href="#" class="mx-3 text-dark fw-bold">TIENDA</a>
                    <a href="#" class="mx-3 text-dark fw-bold">NOSOTROS</a>
                    <a href="#" class="mx-3 text-dark fw-bold">SERVICIOS</a>
                </div>
            </div>
        </section>

        <!-- Slider de productos -->
        <section class="product-slider-section py-4">
            <div class="container position-relative">
                <button class="slider-arrow left-arrow" id="btn-left">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <div class="slider-track-container">
                    <div class="slider-track" id="slider-track">
                        <?php include __DIR__ . '/app/obtener_productos.php'; ?>
                    </div>
                </div>
                
                <button class="slider-arrow right-arrow" id="btn-right">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/tienda.js?v=<?php echo time(); ?>"></script>
    
    <script>
    // Slider functionality
    const track = document.getElementById('slider-track');
    if (track) {
        document.getElementById('btn-left')?.addEventListener('click', () => {
            track.scrollBy({ left: -300, behavior: 'smooth' });
        });
        document.getElementById('btn-right')?.addEventListener('click', () => {
            track.scrollBy({ left: 300, behavior: 'smooth' });
        });
    }
    </script>
</body>
</html>