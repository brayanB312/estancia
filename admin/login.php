<?php
session_start();
require __DIR__ . '/../conn.php';

// Inicializa todas las variables al principio
$error = '';
$email = ''; // Definimos la variable aquí para que siempre exista

// Debug
error_log("Intento de login con: " . ($_POST['email'] ?? ''));

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? LIMIT 1");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if($usuario){
        error_log("Hash en BD: " . $usuario['contrasena']);
        error_log("Contraseña ingresada: " . $password);
        
        // Verificación mejorada
        if($usuario['contrasena'] === $password || password_verify($password, $usuario['contrasena'])){
            if($usuario['rol'] == 'admin'){
                $_SESSION['admin'] = true;
                header("Location: dashboard.php");
                exit;
            }
        }
    }
    
    // Mensaje genérico por seguridad
    $error = "Credenciales incorrectas";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            background: #f4f4f9; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }
        button:hover {
            background: #1a252f;
        }
        .error {
            color: #e74c3c;
            background: #ffebee;
            padding: 0.75rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Acceso Administrativo</h1>
        
        <?php if(!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>