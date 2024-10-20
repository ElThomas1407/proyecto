<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html"); // Redirigir a la página de login si no está autenticado
    exit();
}

include 'productoM.php'; // Incluimos la clase Producto

// Verificamos si se ha enviado el ID del producto
if (isset($_POST['id'])) {
    $productoModel = new Producto();
    $producto = $productoModel->Consultar($_POST['id']);
}

// Si se envía el formulario de actualización
if (isset($_POST['actualizar'])) {
    $productoModel = new Producto();
    $productoModel->Actualizar($_POST['id'], $_POST['nombre_producto'], $_POST['color'], $_POST['descripcion'], $_POST['valor'], $_POST['cantidad_bodega']);
    
    // Redirigir de vuelta a la lista de productos
    header('Location: Consultaproducto.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <!-- Añadimos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Actualizar Producto</h2>

        <?php if (isset($producto)): ?>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                <div class="form-group">
                    <label for="nombre_producto">Nombre del Producto</label>
                    <input type="text" name="nombre_producto" class="form-control" value="<?= $producto['nombre_producto'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" name="color" class="form-control" value="<?= $producto['color'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" required><?= $producto['descripcion'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" name="valor" class="form-control" value="<?= $producto['valor'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="cantidad_bodega">Cantidad en Bodega</label>
                    <input type="number" name="cantidad_bodega" class="form-control" value="<?= $producto['cantidad_bodega'] ?>" required>
                </div>
                <button type="submit" name="actualizar" class="btn btn-success">Actualizar Producto</button>
            </form>
        <?php else: ?>
            <div class="alert alert-danger">No se encontró el producto.</div>
        <?php endif; ?>
    </div>
</body>
</html>
