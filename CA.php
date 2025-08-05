<?php
require 'conn.php';

// Configura estos valores
$admin_data = [
    'nombre' => 'Admin Principal',
    'correo' => 'admin@tutienda.com',
    'contrasena' => 'ClaveSegura123!', // Cambia esta contraseña
    'rol' => 'admin'
];

// Hashear la contraseña
$admin_data['contrasena'] = password_hash($admin_data['contrasena'], PASSWORD_BCRYPT);

try {
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES (?, ?, ?, ?)");
    $stmt->execute(array_values($admin_data));
    
    echo "✅ Administrador creado exitosamente<br>";
    echo "📧 Email: ".htmlspecialchars($admin_data['correo'])."<br>";
    echo "🔑 Contraseña: (la que escribiste en el código)<br><br>";
    echo "⚠️ IMPORTANTE: Elimina este archivo ahora mismo con: unlink(__FILE__);";

    // Descomenta la siguiente línea para auto-eliminarse
    // unlink(__FILE__);
} catch(PDOException $e) {
    echo " Error: ".htmlspecialchars($e->getMessage());
}
?>