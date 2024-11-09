<?php
session_start();

// Conexión a la base de datos
include 'conexion.php';

// Lógica de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar que ambos campos están completos
    if (empty($username) || empty($password)) {
        $error = "Por favor, ingrese usuario y contraseña.";
    } else {
        // Consulta para obtener el usuario
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar si el usuario está activo o inactivo
            if ($user['status'] == 'inactive') {
                $error = "Usuario bloqueado. Contacte con el administrador.";
            } else {
                // Verificar la contraseña
                if (password_verify($password, $user['password'])) {
                    // Si la contraseña es correcta, iniciar sesión
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    header("Location: dashboard.php");
                    exit;
                } else {
                    $error = "Usuario o contraseña incorrectos.";
                }
            }
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}

// Si el usuario ya ha iniciado sesión, redirigir al dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Iniciar Sesión</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Formulario de login -->
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" class="form-control" id="username" name="username" value="" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.5/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
