<?php

// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html"); // Redirigir a la página de login si no está autenticado
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f6fa;
        }

        /* Encabezado */
        .navbar-custom {
            background-color: #2a5ca8;
            color: #fff;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-custom .logo img {
            width: 150px;
            height: auto;
        }
        .navbar-custom .logout {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            background-color: #e74c3c;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .navbar-custom .logout:hover {
            background-color: #c0392b;
        }

        /* Estilos de tarjetas */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 20px;
            text-align: center;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .card p {
            color: #777;
        }
        .card .btn-primary {
            background-color: #2a5ca8;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .card .btn-primary:hover {
            background-color: #1e4381;
        }
        
        /* Contenedor principal */
        .container-custom {
            margin-top: 40px;
        }

        /* Sección de título */
        .title-section h1 {
            font-weight: bold;
            color: #2a5ca8;
        }
        .title-section span {
            font-size: 1.1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <header class="navbar-custom">
        <div class="logo">
            <img src="#" alt="Gafra Logo">
        </div>
        <a href="logout.php" class="logout">Cerrar sesión</a>

    </header>

    <!-- Contenido principal -->
    <main class="container container-custom">
        <div class="title-section text-center mb-4">
            <h1>Administrador</h1>
            <span>gestiona tus servicios</span>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <h3>Usuarios</h3>
                    <p>Consulta tus servicios de Usuarios</p>
                    <a href="panelusuarios.php" class="btn btn-primary">Ir a Usuarios</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <h3>Productos</h3>
                    <p>Consulta tus Productos</p>
                    <a href="panelproductos.php" class="btn btn-primary">Ir a Productos</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <h3>Pre-Orden</h3>
                    <p>Consulta tus Pre-Ordenes</p>
                    <a href="panelpreorden.php" class="btn btn-primary">Ir a Pre-Orden</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <h3>Ventas</h3>
                    <p>Consulta las ventas realizadas</p>
                    <a href="panelventas.php" class="btn btn-primary">Ir a Ventas</a>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
