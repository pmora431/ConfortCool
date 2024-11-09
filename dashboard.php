<?php
session_start();

// Verificar si el usuario ha iniciado sesión, si no, redirigir a la página de login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=no_logged_in");
    exit;
}

// Incluir la conexión a la base de datos
include 'conexion.php';

// Lógica para cerrar sesión
if (isset($_GET['logout'])) {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: login.php"); // Redirige al login
    exit;
}

// Lógica para agregar usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Validar datos del formulario
    if (empty($username) || empty($password) || empty($role) || empty($status)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Verificar si el usuario ya existe
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);

        if ($stmt->rowCount() > 0) {
            $error = "El usuario ya existe. Elija otro nombre.";
        } else {
            // Preparar la consulta para insertar el nuevo usuario
            $sql = "INSERT INTO usuarios (username, password, role, status) VALUES (:username, :password, :role, :status)";
            $stmt = $pdo->prepare($sql);

            // Ejecutar la consulta
            if ($stmt->execute([
                ':username' => $username,
                ':password' => $hashed_password,
                ':role' => $role,
                ':status' => $status
            ])) {
                $success = "Usuario agregado exitosamente.";
            } else {
                $error = "Hubo un problema al agregar el usuario. Inténtelo nuevamente.";
            }
        }
    }
}

// Lógica para modificar la imagen del banner
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['banner_image'])) {
    $target_dir = "img/";
    $target_file = $target_dir . "banner.jpeg";  // Se asegurará de que siempre sea el archivo 'banner.jpeg'
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si es una imagen real o un archivo falso
    if (getimagesize($_FILES["banner_image"]["tmp_name"]) === false) {
        $error_image = "El archivo no es una imagen válida.";
    }
    // Verificar el tipo de archivo
    elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error_image = "Solo se permiten imágenes JPG, JPEG, PNG y GIF.";
    }
    // Intentar mover el archivo a la carpeta img
    else {
        if (move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target_file)) {
            $success_image = "La imagen del banner se ha actualizado exitosamente.";
        } else {
            $error_image = "Hubo un error al cargar la imagen. Inténtalo nuevamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Panel de Control</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?logout=true">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Título del dashboard -->
    <h1 class="text-center">Bienvenido al Panel de Control</h1>

    <!-- Mensajes de error y éxito -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error_image)): ?>
        <div class="alert alert-danger">
            <?php echo $error_image; ?>
        </div>
    <?php elseif (isset($success_image)): ?>
        <div class="alert alert-success">
            <?php echo $success_image; ?>
        </div>
    <?php endif; ?>

    <!-- Pestañas para las secciones -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Gestionar y Agregar Usuario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="banner-tab" data-toggle="tab" href="#banner" role="tab" aria-controls="banner" aria-selected="false">Modificar Imagen del Banner</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- Gestionar y Agregar Usuario -->
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="card mt-4">
                <div class="card-header">
                    Agregar Usuario
                </div>
                <div class="card-body">
                    <form method="POST" action="dashboard.php">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" name="add_user" class="btn btn-primary">Agregar Usuario</button>
                    </form>

                    <!-- Gestionar Usuarios -->
                    <h3 class="mt-4">Gestionar Usuarios</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Rol</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Consulta para obtener los usuarios
                            $sql = "SELECT * FROM usuarios";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Mostrar usuarios
                            foreach ($usuarios as $usuario) {
                                echo "<tr>";
                                echo "<td>{$usuario['id']}</td>";
                                echo "<td>{$usuario['username']}</td>";
                                echo "<td>{$usuario['role']}</td>";
                                echo "<td>{$usuario['status']}</td>";
                                echo "<td><a href='edit_user.php?id={$usuario['id']}' class='btn btn-warning'>Editar</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modificar Imagen del Banner -->
        <div class="tab-pane fade" id="banner" role="tabpanel" aria-labelledby="banner-tab">
            <div class="card mt-4">
                <div class="card-header">
                    Modificar Imagen del Banner
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="dashboard.php">
                        <div class="form-group">
                            <label for="banner_image">Seleccionar nueva imagen de banner:</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Banner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
