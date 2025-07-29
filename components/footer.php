<?php
function footer(){
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Inter", sans-serif;
        text-decoration: none;
    }

    .footer {
        background-color: #222;
        color: #fff;
        padding: 40px 20px 20px;
        font-size: 14px;
        margin-top: 100px;
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 1200px;
        margin: auto;
    }

    .footer-section {
        flex: 1 1 200px;
        margin: 10px;
    }

    .footer-section h3 {
        margin-bottom: 10px;
        color: #f0f0f0;
    }

    .footer-section a {
        color: #bbb;
        text-decoration: none;
    }

    .footer-section a:hover {
        color: #fff;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 20px;
        border-top: 1px solid #444;
        padding-top: 10px;
        font-size: 12px;
        color: #aaa;
    }


</style>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <h3>Mi Empresa</h3>
      <p>Dirección, Ciudad, País</p>
      <p>Tel: +52 123 456 7890</p>
    </div>
    <div class="footer-section">
      <h3>Enlaces</h3>
      <ul>
        <li><a href="index.php">Tienda</a></li>
        <li><a href="#">Nosotros</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Síguenos</h3>
      <a href="#">Facebook</a><br>
      <a href="#">Instagram</a><br>
      <a href="#">Twitter</a>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 Mi Empresa. Todos los derechos reservados.
  </div>
</footer>

<?php
}
?>