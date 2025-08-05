<?php if(!isset($_SESSION)) session_start(); ?>
<nav class="navbar" style="background: #2c3e50; padding: 15px 0;">
    <div class="navbar-container" style="
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    ">
        <a href="dashboard.php" class="navbar-link" style="
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        ">Panel Admin</a>
        <div style="display: flex; align-items: center; gap: 20px;">
            <?php if(isset($_SESSION['user_name'])): ?>
                <span class="navbar-user" style="color: #ecf0f1;">Hola, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
            <?php endif; ?>
            <a href="logout.php" class="navbar-link" style="
                color: white;
                text-decoration: none;
                padding: 5px 10px;
                border: 1px solid white;
                border-radius: 3px;
                transition: all 0.3s ease;
            ">Cerrar sesión</a>
        </div>
    </div>
</nav>