<?php
require 'conn.php';

$email = 'admin@gmail.com';
$password = 'password';

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

echo "<pre>";
echo "Usuario de BD:\n";
print_r($user);
echo "\n\nVerificación:\n";
echo "Contraseña coincide: " . (password_verify($password, $user['contrasena']) ? 'SÍ' : 'NO');
echo "\nRol es admin: " . ($user['rol'] == 'admin' ? 'SÍ' : 'NO');
echo "</pre>";