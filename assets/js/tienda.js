document.addEventListener('DOMContentLoaded', () => {
    const botones = document.querySelectorAll('.agregar-carrito');
    
    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const productoId = boton.getAttribute('data-id');
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            
            const productoExistente = carrito.find(item => item.id === productoId);
            
            if (productoExistente) {
                productoExistente.cantidad += 1; 
            } else {
                carrito.push({ 
                    id: productoId, 
                    cantidad: 1  
                });
            }

            localStorage.setItem('carrito', JSON.stringify(carrito));
            alert("Producto agregado al carrito!");
        });
    });
});