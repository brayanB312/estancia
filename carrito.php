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
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<?php navbar() ?>

<div class="container">

  <section class="cart-items">
    <div class="cart-header">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="21" r="1" /><circle cx="20" cy="21" r="1" /><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" /></svg>
      Carrito de Compras
      <span class="cart-count">0 artículos</span>
    </div>
    <div id="cart-items-list"></div>
  </section>

  <aside class="order-summary">
    <h2>Resumen del Pedido</h2>
    <div class="summary-row">
      <div>Subtotal</div>
      <div id="cart-subtotal">$0.00</div>
    </div>
    <div class="summary-row">
      <div>Envío</div>
      <div class="highlight">¡Gratis!</div>
    </div>
    <div class="summary-row">
      <div>Impuestos</div>
      <div id="cart-tax">$0.00</div>
    </div>

    <div class="divider"></div>

    <div class="summary-row" style="font-size: 1.3rem;">
      <div>Total</div>
      <div id="cart-total">$0.00</div>
    </div>

    <button class="btn-primary" id="stripe-checkout">Pagar con Stripe</button>
    <button class="btn-secondary">Continuar Comprando</button>
  </aside>

</div>
    
</body>
</html>
<script src="carrito.js"></script>