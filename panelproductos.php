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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #1746A2;
            padding: 10px 30px;
        }

        .navbar .logo img {
            height: 40px;
            width: auto;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ddd !important;
        }

        .title-section {
            text-align: center;
            padding: 40px 20px;
            background-color: #1746A2;
            color: white;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            flex: 0 1 calc(25% - 20px);
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .card h2 {
            color: #1746A2;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card p {
            color: #6c757d;
            margin-bottom: 15px;
        }

        .btn {
            color: white;
            background-color: #1746A2;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover {
            background-color: #143d82;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .card {
                flex: 0 1 calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .card {
                flex: 0 1 calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="#">
                <img src="logo.png" alt="Gafra Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="history.back();"><i class="fas fa-arrow-left"></i> Regresar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="panel.php"><i class="fas fa-home"></i> Inicio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="title-section">
        <h1>Administrador</h1>
        <p>Gestiona tus servicios</p>
    </div>

    <div class="container">
        <div class="card">
            <h2><i class="fas fa-plus-circle"></i> Registro</h2>
            <p>Registra un nuevo producto</p>
            <a href="registroproducto.php" class="btn">Ir a Registro de Productos</a>
        </div>
        <div class="card">
            <h2><i class="fas fa-search"></i> Consulta</h2>
            <p>Consulta un producto</p>
            <a href="Consultaproducto.php" class="btn">Ir a consulta de Productos</a>
        </div>
        <div class="card">
            <h2><i class="fas fa-edit"></i> Actualización</h2>
            <p>Actualiza un producto</p>
            <a href="Actualizacionproductos.php" class="btn">Ir a Actualizar Productos</a>
        </div>
        <div class="card">
            <h2><i class="fas fa-trash-alt"></i> Eliminación</h2>
            <p>Elimina un producto</p>
            <a href="eliminarproducto.php" class="btn">Ir a Eliminar Productos</a>
        </div>
    </div>

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
