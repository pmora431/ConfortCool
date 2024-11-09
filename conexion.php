<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "confortcool";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

try {
    // Cambia los parámetros según tu configuración (host, nombre de la base de datos, usuario y contraseña)
    $pdo = new PDO('mysql:host=localhost;dbname=confortcool', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Para manejar errores de forma detallada
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

//echo "Conexión exitosa a la base de datos";
?>
