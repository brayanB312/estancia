<?php
include 'components/navbar.php';
include 'components/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/carrito.css">
</head>
<body>

<?php navbar() ?>

<div class="container">

  <section class="cart-items">
    <div class="cart-header">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="21" r="1" /><circle cx="20" cy="21" r="1" /><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" /></svg>
      Carrito de Compras
      <span class="cart-count">4 artículos</span>
    </div>

    <article class="cart-item">
      <img src="https://via.placeholder.com/80?text=Img" alt="Camiseta Premium" />
      <div class="item-info">
        <div class="item-name">Camiseta Premium</div>
        <div class="item-details">Talla: M &nbsp;|&nbsp; Color: Azul</div>
        <div class="quantity-control">
          <button aria-label="Disminuir cantidad">−</button>
          <input type="text" readonly value="2" aria-label="Cantidad de Camiseta Premium" />
          <button aria-label="Aumentar cantidad">+</button>
        </div>
      </div>
      <div class="item-price">
        $59.98
        <small>$29.99 c/u</small>
      </div>
      <div class="remove-item" title="Eliminar artículo">🗑️</div>
    </article>

    <article class="cart-item">
      <img src="https://via.placeholder.com/80?text=Img" alt="Jeans Clásicos" />
      <div class="item-info">
        <div class="item-name">Jeans Clásicos</div>
        <div class="item-details">Talla: 32 &nbsp;|&nbsp; Color: Negro</div>
        <div class="quantity-control">
          <button aria-label="Disminuir cantidad">−</button>
          <input type="text" readonly value="1" aria-label="Cantidad de Jeans Clásicos" />
          <button aria-label="Aumentar cantidad">+</button>
        </div>
      </div>
      <div class="item-price">
        $79.99
        <small>$79.99 c/u</small>
      </div>
      <div class="remove-item" title="Eliminar artículo">🗑️</div>
    </article>

    <article class="cart-item">
      <img src="https://via.placeholder.com/80?text=Img" alt="Zapatillas Deportivas" />
      <div class="item-info">
        <div class="item-name">Zapatillas Deportivas</div>
        <div class="item-details">Talla: 42 &nbsp;|&nbsp; Color: Blanco</div>
        <div class="quantity-control">
          <button aria-label="Disminuir cantidad">−</button>
          <input type="text" readonly value="1" aria-label="Cantidad de Zapatillas Deportivas" />
          <button aria-label="Aumentar cantidad">+</button>
        </div>
      </div>
      <div class="item-price">
        $129.99
        <small>$129.99 c/u</small>
      </div>
      <div class="remove-item" title="Eliminar artículo">🗑️</div>
    </article>
  </section>

  <aside class="order-summary">
    <h2>Resumen del Pedido</h2>
    <div class="summary-row">
      <div>Subtotal</div>
      <div>$269.96</div>
    </div>
    <div class="summary-row">
      <div>Envío</div>
      <div class="highlight">¡Gratis!</div>
    </div>
    <div class="summary-row">
      <div>Impuestos</div>
      <div>$27.00</div>
    </div>

    <div class="divider"></div>

    <div class="summary-row" style="font-size: 1.3rem;">
      <div>Total</div>
      <div>$296.96</div>
    </div>

    <button class="btn-primary">Proceder al Pago</button>
    <button class="btn-secondary">Continuar Comprando</button>
  </aside>

</div>
    
</body>
</html>