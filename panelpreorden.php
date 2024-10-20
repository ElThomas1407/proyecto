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
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <div class="container">
            <div class="card">
                <h2>Registra</h2>
                <p>Registra una Pre-ordenes </p>
                <a href="preordenregistro.php" class="btn">Ir a Formulario de registro</a> 
            </div>
            <div class="card">
                <h2>Consulta</h2>
                <p>Consulta tus Pre-ordenes</p>
                <a href="consultapreorden.php" class="btn">Ir a Reportes de Pre-orden</a> 
            </div>
            <div class="card">
                <h2>Actualiza</h2>
                <p>Actualiza tus Pre-ordenes realizadas</p>
                <a href="actualizar_preorden_form.php" class="btn">Ir Actualizar Pre-orden</a> 
            </div>
            <div class="card">
                <h2>Elimina</h2>
                <p>Elimina las Pre-ordenes realizadas</p>
                <a href="eliminarpreorden.php" class="btn">Ir a Eliminar Pre-orden</a> 
            </div>
        </div>
    </main>
</body>
</html>
