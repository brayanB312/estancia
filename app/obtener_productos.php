<?php
include_once __DIR__ . '/../conexion.php';

$resultado = $conexion->query("SELECT * FROM productos");

while ($producto = $resultado->fetch_assoc()) {
    $img = htmlspecialchars($producto['imagen']);
    $nombre = htmlspecialchars($producto['nombre']);
    $descripcion = htmlspecialchars($producto['descripcion']);
    $precio = number_format($producto['precio'], 2);

    echo "
        <div class='bg-white rounded-lg shadow-md flex-shrink-0' style='min-width: 250px;'>
            <div class='h-48 flex items-center justify-center bg-white pt-4'>
                <img src='$img' alt='$nombre' class='max-h-full max-w-full object-contain' />
            </div>
            <div class='p-4'>
             <h5 class='text-lg font-semibold'>$nombre</h5>
             <p class='text-sm text-gray-600 mb-2'>$descripcion</p>
             <p class='text-green-600 font-bold mb-3'>$$precio</p>
                 <a href='#' class='bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600'>Comprar</a>
            </div>
        </div>


    ";
}
?>
