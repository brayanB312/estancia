<?php
function navbar(){
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Inter", sans-serif;
        text-decoration: none;
        scroll-behavior: smooth;
    }
    
    a{
        color: #000;
    }

    .navbar{
        background-color: #FFFFFF;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 10px 35px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: solid 1px #EEEEEE;
        z-index: 1000;
    }

    .nav_1{
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav_1 img{
        max-height: 60px;
    }

    .nav_1 p{
        font-size: 2rem;
    }

    .nav_2{
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .nav_2 form{
        width: 80%;
        max-width: 800px;
        display: flex;
    }

    .nav_2 input{
        width: 100%;
        padding: 10px 12px;
        font-size: 1rem;
        border: solid 1px #CCCCCC;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .nav_2 button{
        font-size: 1rem;
        padding: 10px 12px;
        border: solid 1px #CCCCCC;
        background-color: #fff;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .nav_2 button:hover{
        background-color: #EEE;
    }

    .nav_3{
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .nav_3 a{
        font-size: 1rem;
        color: #000;
    }

    .nav_4{
        display: flex;
        align-items: center;
    }

    .nav_4_cart{
        position: relative;
        display: inline-block;
        padding-left: 50px;
    }

    #cart{
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    #cart:hover{
        transform: scale(1.1);
    }

    #cart_contador{
        position: absolute;
        top: 12px;
        right: -8px;
        background-color: red;
        color: #FFF;
        border-radius: 50%;
        padding: 1px 5px;
        font-size: 12px;
    }

    .mobile{
        display: none;
    }

    #menuToggle{
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    #menuToggle:hover{
        transform: scale(1.1);
    }

    .mobile_menu {
        position: fixed;
        top: -100%;
        left: 0;
        width: 100%;
        background-color: white;
        padding: 20px;
        border-bottom: 1px solid #EEEEEE;
        transition: top 0.4s ease;
        z-index: 999;
    }

    .mobile_menu.show {
        top: 75px;
    }

    .mobile_menu form {
        display: flex;
        margin-bottom: 20px;
    }

    .mobile_menu input {
        flex: 1;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .mobile_menu button {
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        cursor: pointer;
    }

    .mobile_menu a {
        display: block;
        margin-bottom: 10px;
        font-size: 1rem;
        color: #000;
    }

    @media (max-width: 1024px) {
        .nav_3{
            gap: 15px;
        }

        .nav_4_cart{;
            padding-left: 15px;
    }
    }

    @media (max-width: 768px) {
        .nav_2, .nav_3 {
            display: none;
        }

        .mobile {
            display: flex;
        }

        .nav_4_cart {
            padding-left: 20px;
        }
    }
</style>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<div class="navbar">
    <div class="nav_1">
        <img src="assets/images/logo.webp">
        <p><a href="#">Tienda</a></p>
    </div>
    <div class="nav_2">
        <form action="busqueda.php" method="GET">
            <input name="q" type="search" placeholder="Buscar productos...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="nav_3">
        <a href="index.php">Tienda</a>
        <a href="#">Nosotros</a>
        <a href="#">Contacto</a>
    </div>
    <div class="nav_4">
        <div class="mobile">
            <i class="fa-solid fa-bars" id="menuToggle"></i>
        </div>
        <div class="nav_4_cart">
            <a href="carrito.php"><i class="fa fa-shopping-cart" id="cart"></i></a>
            <span id="cart_contador">0</span>
        </div>
    </div>
</div>

<div class="mobile_menu" id="mobileMenu">
    <form action="busqueda.php" method="GET">
        <input name="q" type="search" placeholder="Buscar productos...">
        <button><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <a href="index.php">Tienda</a>
    <a href="#">Nosotros</a>
    <a href="#">Contacto</a>
</div>

<script>
    const menuBtn = document.getElementById("menuToggle");
    const mobileMenu = document.getElementById("mobileMenu");

    let menuOpen = false;

    function toggleMenu() {
        menuOpen = !menuOpen;
        if (menuOpen) {
            mobileMenu.classList.add("show");
            menuBtn.classList.remove("fa-bars");
            menuBtn.classList.add("fa-xmark");
        } else {
            mobileMenu.classList.remove("show");
            menuBtn.classList.remove("fa-xmark");
            menuBtn.classList.add("fa-bars");
        }
    }

    menuBtn.addEventListener("click", toggleMenu);

    window.addEventListener("resize", () => {
        if (window.innerWidth > 768 && menuOpen) {
            menuOpen = false;
            mobileMenu.classList.remove("show");
            menuBtn.classList.remove("fa-xmark");
            menuBtn.classList.add("fa-bars");
        }
    });
</script>


<?php
}
?>
