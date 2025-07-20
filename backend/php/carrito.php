<?php
include 'conexion.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Carrito de Compras</h1>
        <div id="lista-carrito" class="mt-3"></div>
        <div id="total" class="h4 mt-3">Total: $0.00</div>
        <button id="vaciar-carrito" class="btn btn-danger mt-2">Vaciar Carrito</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            
            if (carrito.length === 0) {
                document.getElementById('lista-carrito').innerHTML = '<p>El carrito está vacío</p>';
                return;
            }

            const ids = carrito.map(item => item.id).join(',');
            
            try {
                const response = await fetch(`obtener_productos_carrito.php?ids=${ids}`);
                const productos = await response.json();

                
                const carritoCompleto = carrito.map(item => {
                    const producto = productos.find(p => p.id == item.id);
                    return { ...producto, cantidad: item.cantidad };
                });

                
                let html = '';
                let total = 0;
                
                carritoCompleto.forEach(producto => {
                   
                    const precio = parseFloat(producto.precio); 
                    const subtotal = precio * producto.cantidad;
                    total += subtotal;

                    html += `
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5>${producto.nombre}</h5>
                                <p>Precio: $${precio.toFixed(2)}</p>  <!-- Usamos precio convertido -->
                                <p>Cantidad: ${producto.cantidad}</p>
                                <p>Subtotal: $${subtotal.toFixed(2)}</p>
                            </div>
                        </div>
                    `;
                });

                document.getElementById('lista-carrito').innerHTML = html;
                document.getElementById('total').textContent = `Total: $${total.toFixed(2)}`;
            } catch (error) {
                console.error('Error:', error);
            }
        });

        function eliminarDelCarrito(id) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito = carrito.filter(item => item.id !== id);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            location.reload(); 
        }

        
        document.getElementById('vaciar-carrito').addEventListener('click', () => {
            localStorage.removeItem('carrito');
            location.reload();
        });
    </script>
</body>
</html>