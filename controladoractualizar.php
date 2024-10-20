<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html"); // Redirigir a la página de login si no está autenticado
    exit();
}

include 'proyectoM.php'; // Cambiar a include si prefieres

if (isset($_GET['id'])) {
    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->Consultar($_GET['id']); // Consulta el usuario directamente

    if (!$usuario) {
        echo "<script>alert('Usuario no encontrado'); window.location.href='controladorconsulta.php';</script>";
        exit; // Detiene la ejecución si el usuario no se encuentra
    }
}

// Si se recibe un formulario POST
if (!empty($_POST)) {
    $usuarioModel = new Usuario();
    if ($usuarioModel->Actualizar($_GET['id'], $_POST['nombre'], $_POST['correo_electronico'], $_POST['telefono'], $_POST['tipo_usuario'])) {
        echo "<script>alert('Usuario actualizado exitosamente'); window.location.href='controladorconsulta.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el usuario'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Actualizar Usuario</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?= htmlspecialchars($usuario['correo_electronico']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">
            </div>
            <div class="mb-3">
                <div class="mb-3">
            <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
            <select class="form-control" id="tipo_usuario" name="tipo_usuario" style="pointer-events: none; background-color: #e9ecef;" readonly>
             <option value="admin" <?= $usuario['tipo_usuario'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
            <option value="logistica" <?= $usuario['tipo_usuario'] == 'logistica' ? 'selected' : '' ?>>Logística</option>
        </select>
        </div>  
        </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
