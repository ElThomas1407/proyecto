<?php

session_start();

// Conectar a la base de datos (mantenido igual)
$conexion = new PDO("mysql:host=localhost;dbname=gafra", "root", );
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Obtener los datos del formulario
$nom_usuario = $_POST['nom_usuario'];
$contrasena = $_POST['contrasena'];

// Validar el usuario en la base de datos
$query = "SELECT id, tipo_usuario FROM usuario WHERE nom_usuario = :nom_usuario AND contrasena = :contrasena AND estado_usuario = 'activo'";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':nom_usuario', $nom_usuario);
$stmt->bindParam(':contrasena', $contrasena);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    // Si el usuario existe y está activo, obtener los datos
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Guardar datos en la sesión
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
    $_SESSION['nom_usuario'] = $nom_usuario;
    
    // Redirigir según el tipo de usuario
    if ($user['tipo_usuario'] == 'admin') {
        header("Location: panel.php");
    } elseif ($user['tipo_usuario'] == 'logistica') {
        header("Location: logistica_dashboard.php");
    } elseif ($user['tipo_usuario'] == 'cliente') {
        header("Location: Gafrainicio.php");
    }
    exit();
} else {
    // Redirigir al formulario de inicio de sesión con el parámetro de error
    header("Location: Login.html?error=1");
    exit();
}
?>
