<?php 

$host = 'localhost';
$db = 'tienda';
$user = 'root';
$password = '';

try {

    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}   catch (PDOException $e) {
        die("Error de conexion". $e->getMessage());
}

?>