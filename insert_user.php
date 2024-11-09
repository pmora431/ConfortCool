<?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php'; // Asegúrate de que 'conexion.php' contiene tu conexión a la base de datos

// Datos del nuevo usuario
$username = 'admin'; // Nombre de usuario
$password = 'SuperAdmin123'; // Contraseña en texto plano
$role = 'admin'; // Rol del usuario
$status = 'active'; // Estado del usuario (activo/inactivo)

try {
    // Generar el hash de la contraseña usando password_hash (bcrypt)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (username, password, role, status) 
            VALUES (:username, :password, :role, :status)";
    
    // Preparar la consulta
    $stmt = $pdo->prepare($sql);
    
    // Ejecutar la consulta con los valores
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashed_password, // Contraseña encriptada
        ':role' => $role,
        ':status' => $status
    ]);

    // Confirmar que el usuario fue creado correctamente
    echo "Usuario Admin creado exitosamente.";

} catch (PDOException $e) {
    echo "Error al preparar o ejecutar la consulta: " . $e->getMessage();
}
?>
