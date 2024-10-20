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
    <link rel="stylesheet" href="EstilosPanel.css">
    <style>
                
                .card {
            background-color: #f9f9f9; 
            border: 1px solid #ddd; 
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            transition: box-shadow 0.3s;
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: blue; 
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="logo.png" alt="Gafra Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="#">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="title-section">
            <h1>Administrador</h1>
            <span>gestiona tus servicios</span>
        </div>
        <div class="container">
            <div class="card">
                <h2>Registra</h2>
                <p>Registra un nuevo usuario </p>
                <a href="gafraregistro2.php" class="btn">Ir a Formulario de Registro</a> 
            </div>
            <div class="card">
                <h2>Consulta</h2>
                <p>Consulta Usuarios registrados</p>
                <a href="controladorconsulta.php" class="btn">Ir a Reporte  de Usuarios</a> 
            </div>
            <div class="card">
                <h2>Actualiza</h2>
                <p>Actualiza datos de un usuario</p>
                <a href="controladorconsultactualizar.php" class="btn">Ir a Actualizacion de Datos</a> 
            </div>
            <div class="card">
                <h2>Elimina</h2>
                <p>Elimina un usuario</p>
                <a href="controladorconsultaeliminar.php" class="btn">Ir a Eliminacion de Usuarios</a> 
            </div>
        </div>
    </main>
</body>
</html>
