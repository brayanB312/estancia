<?php 
function navbar($logo_url, $title) {
?>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
    }

    .navbar {
        background-color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 10px 35px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
        border-bottom: 1px solid #EEEEEE;
        height: 75px;
    }

    .left_nav {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .left_nav h1{
        font-size: 28px;
    }

    .logo_img {
        max-height: 50px;
        width: auto;
    }

    .center_nav {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .center_nav input {
        width: 100%;
        font-size: 16px;
        padding: 8px 12px;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        border: 1px solid #CCCCCC;
        background-color: #F4F4F4;
    }

    .desktop_menu {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .desktop_menu a {
        color: #000;
        font-weight: bold;
        transition: color 0.4s ease;
    }

    .desktop_menu a:hover{
        color: #202020;
        text-decoration: underline;
    }

    .carrito_container {
        position: relative;
        display: inline-block;
    }

    #contador_carrito {
        position: absolute;
        top: 12px;
        right: -8px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 1px 5px;
        font-size: 12px;
    }

    .mobile_menu {
        display: none;
        gap: 20px;
    }

    .navbar_slider {
        max-height: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 999;
        margin-top: 75px;
        background-color: #E3E3E3;
        padding: 0;
        gap: 0;
        transition: max-height 0.3s ease, padding 0.3s ease, gap 0.3s ease;
    }

    .navbar_slider.show {
        max-height: 400px; 
        padding: 20px 0;
        gap: 20px;
    }

    .navbar_slider a {
        color: #000;
        font-weight: bold;
        transition: color 0.4s ease;
    }

    .navbar_slider a:hover{
        color: #202020;
        text-decoration: underline;
    }

    .navbar_slider input {
        width: 100%;
        font-size: 16px;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #CCCCCC;
    }

    #cart{
        font-size: 24px; 
        cursor: pointer;
        transition: transform 0.3s ease;
        transition: color 0.4s ease;
    }

    #cart:hover{
        color: #202020; 
        transform: scale(1.1);
    }

    .search_form{
        width: 80%;
        max-width: 600px;
        display: flex;
        align-items: center;
    }

    .search_form button{
        height: 100%;
        width: 40px;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        border: 1px solid #CCCCCC;
        cursor: pointer;
        background-color: #E3E3E3;
        transition: background-color 0.4s ease;
    }

    .search_form button:hover{
        background-color: #D3D3D3;
    }

    @media (max-width: 768px) {
        .mobile_menu {
            display: flex;
        }

        #form_button{
            display: none;
        }

        .desktop_menu,
        .center_nav input {
            display: none !important;
        }

        .left_nav h1{
            font-size: 24px;
        }
    }
</style>

<script>
    function toggleMenu() {
        const desktop = document.querySelector(".desktop_menu");
        const mobile = document.querySelector(".mobile_menu");
        const search = document.querySelector(".search_bar");
        const mobile_menu = document.querySelector(".navbar_slider");

        if (window.innerWidth <= 768) {
            if (desktop) desktop.style.display = "none";
            if (mobile) mobile.style.display = "flex";
            if (search) search.style.display = "none";
        } else {
            if (desktop) desktop.style.display = "flex";
            if (mobile) mobile.style.display = "none";
            if (search) search.style.display = "flex";
            if (mobile_menu && mobile_menu.classList.contains("show")) {
                mobile_menu.classList.remove("show");
            }
        }
    }

    function show_menu() {
        const mobile_menu = document.querySelector(".navbar_slider");
        mobile_menu.classList.toggle("show");
    }

    window.addEventListener("load", toggleMenu);
    window.addEventListener("resize", toggleMenu);
</script>


<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<div class="navbar">
    <div class="left_nav">
        <img class="logo_img" src="<?php echo $logo_url; ?>" alt="<?php echo $title; ?>">
        <h1><?php echo $title; ?></h1>
    </div>
    <div class="center_nav">
        <form action="" class="search_form">
            <input class="search_bar" type="search" placeholder="Buscar...">
            <button id="form_button"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="right_nav">
        <div class="desktop_menu">
            <a href="#">Tienda</a>
            <a href="#">Nosotros</a>
            <a href="#">Servicios</a>
            <div class="carrito_container">
                <i class="fa fa-shopping-cart" id="cart"></i>
                <span id="contador_carrito">3</span>
            </div>
        </div>
        <div class="mobile_menu">
            <div class="carrito_container">
                <i class="fa fa-shopping-cart" id="cart"></i>
                <span id="contador_carrito">3</span>
            </div>
            <i class="fa-solid fa-bars" style="font-size: 24px; cursor: pointer;" onclick="show_menu()"></i>
        </div>
    </div>
</div>

<div class="navbar_slider">
    <form action="" class="search_form">
        <input class="search_bar" type="search" placeholder="Buscar...">
    </form>
    <a href="#">Tienda</a>
    <a href="#">Nosotros</a>
    <a href="#">Servicios</a>
</div>

<?php
}
?>
