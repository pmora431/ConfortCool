<?php
// Aquí puedes agregar lógica PHP si lo necesitas, como manejo de sesiones o consultas a la base de datos.
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Repuestos</title>
    <!-- Estilos personalizados -->
    <link href="css/styles.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/logo.png" alt="Logo" width="75"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Inicio de Sesion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ofertas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container">
            <h1>Bienvenido a la Tienda de Repuestos</h1>
            <p>Encuentra los mejores repuestos al mejor precio</p>
            <a href="#productos" class="btn btn-light">Ver productos</a>
        </div>
    </section>

    <!-- Sección para los servicios relacionados con aire acondicionado automotriz -->
    <section id="servicios" class="container py-5">
        <h2 class="text-center mb-4">Servicios para tu Aire Acondicionado Automotriz</h2>
        <div class="row">
            <!-- Card 1: Repuestos de calidad -->
            <div class="col-md-4 mb-4">
                <div class="servicio-card">
                    <div class="servicio-card-body">
                        <h5 class="servicio-card-title">Repuestos de Calidad</h5>
                        <p class="servicio-card-text">Los repuestos para el sistema de aire acondicionado automotriz, como compresores, condensadores, evaporadores, válvulas de expansión, y sensores, deben ser de alta calidad para garantizar un funcionamiento eficiente y duradero. Utilizar piezas originales o de fabricantes de confianza ayuda a prevenir fallas prematuras y asegura un rendimiento óptimo del sistema.</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Mantenimiento Preventivo -->
            <div class="col-md-4 mb-4">
                <div class="servicio-card">
                    <div class="servicio-card-body">
                        <h5 class="servicio-card-title">Mantenimiento Preventivo</h5>
                        <p class="servicio-card-text">El mantenimiento regular del sistema de aire acondicionado automotriz es fundamental para asegurar su buen funcionamiento a lo largo del tiempo. Esto incluye la revisión y limpieza de filtros de aire, inspección de mangueras y conexiones para detectar fugas, así como la comprobación de niveles de refrigerante.</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Reparación de Fallas Comunes -->
            <div class="col-md-4 mb-4">
                <div class="servicio-card">
                    <div class="servicio-card-body">
                        <h5 class="servicio-card-title">Reparación de Fallas Comunes</h5>
                        <p class="servicio-card-text">Las fallas más frecuentes en los sistemas de aire acondicionado automotrices incluyen la pérdida de refrigerante debido a fugas, fallos en el compresor, y problemas con los sensores de temperatura o las válvulas de expansión. En caso de una fuga, se debe localizar y reparar la fuga antes de recargar el sistema con refrigerante.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Productos -->
    <section id="productos" class="container py-5">
        <h2 class="text-center mb-4">Nuestros Productos</h2>
        <div class="row">
            <!-- Producto 1 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-img-container">
                        <img src="img/product1.png" alt="Repuesto 1">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Repuesto 1</h5>
                        <p class="card-text">Descripción breve del repuesto 1. Ideal para mejorar el rendimiento de tu vehículo.</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
    
            <!-- Producto 2 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-img-container">
                        <img src="img/product2.png" alt="Repuesto 2">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Repuesto 2</h5>
                        <p class="card-text">Descripción breve del repuesto 2. Compatible con diversos modelos de vehículos.</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
    
            <!-- Producto 3 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-img-container">
                        <img src="img/product3.png" alt="Repuesto 3">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Repuesto 3</h5>
                        <p class="card-text">Descripción breve del repuesto 3. Excelente opción para quienes buscan calidad y durabilidad.</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
    
            <!-- Producto 4 -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-img-container">
                        <img src="img/product4.png" alt="Repuesto 4">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Repuesto 4</h5>
                        <p class="card-text">Descripción breve del repuesto 4. Ideal para vehículos de alta gama.</p>
                        <a href="#" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 ConfortCool. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts de Bootstrap y JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
