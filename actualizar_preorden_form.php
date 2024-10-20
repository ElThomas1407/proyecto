<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html"); // Redirigir a la página de login si no está autenticado
    exit();
}

include 'PreordenM.php'; // Incluir la clase PreOrden
include 'ProductoM.php'; // Incluir la clase Producto para listar productos

$preOrdenModel = new PreOrden(); // Instancia de la clase PreOrden
$productoModel = new Producto(); // Instancia de la clase Producto

// Verificar si se ha pasado un ID para actualizar
if (isset($_GET['id'])) {
    $idPreorden = $_GET['id'];
    $preOrden = $preOrdenModel->consultarPreOrdenPorIdActiva($idPreorden); // Obtener datos de la pre-orden
    $productosPreorden = $preOrdenModel->obtenerProductosPorPreOrden($idPreorden); // Obtener productos de la pre-orden
    $todosLosProductos = $productoModel->consultarTodos(); // Obtener todos los productos para agregar nuevos
} else {
    header("Location: actualizarPreorden.php"); // Redirigir si no se pasó ID
    exit();
}

// Procesar la actualización al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar los productos existentes
    foreach ($_POST['producto_id'] as $index => $producto_id) {
        $cantidad = $_POST['cantidad'][$index];
        $precio = $_POST['precio'][$index];
        $preOrdenModel->actualizarProductoPreOrden($_POST['id'], $producto_id, $cantidad, $precio);
    }

    // Si se agregan productos nuevos
    if (!empty($_POST['nuevo_producto_id'])) {
        foreach ($_POST['nuevo_producto_id'] as $index => $nuevo_producto_id) {
            $nueva_cantidad = $_POST['nueva_cantidad'][$index];
            $nuevo_precio = $productoModel->obtenerPrecioProducto($nuevo_producto_id);
            $preOrdenModel->agregarProductoPreOrden($_POST['id'], $nuevo_producto_id, $nueva_cantidad, $nuevo_precio);
        }
    }

    // Si se eliminan productos
    if (!empty($_POST['eliminar_producto_id'])) {
        foreach ($_POST['eliminar_producto_id'] as $eliminar_producto_id) {
            $preOrdenModel->eliminarProductoPreOrden($_POST['id'], $eliminar_producto_id);
        }
    }

    header("Location: actualizarPreorden.php?success=true"); // Redirigir después de la actualización exitosa
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Pre-Orden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Actualizar Pre-Orden <?= $preOrden['id'] ?></h2>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
            <div class="alert alert-success" role="alert">
                La pre-orden se actualizó correctamente.
            </div>
        <?php endif; ?>

        <form method="POST" action="actualizar_preorden_form.php?id=<?= $preOrden['id'] ?>">
            <!-- Hidden ID Field -->
            <input type="hidden" name="id" value="<?= $preOrden['id'] ?>">
            <!-- Destino -->
            <div class="mb-3">
                <label for="destino" class="form-label">Destino</label>
                <input type="text" class="form-control" id="destino" name="destino" value="<?= $preOrden['destino'] ?>" required>
            </div>

            <!-- Método de Entrega -->
            <div class="mb-3">
                <label for="metodo_entrega" class="form-label">Método de Entrega</label>
                <select class="form-control" id="metodo_entrega" name="metodo_entrega" required>
                    <option value="domicilio" <?= $preOrden['metodo_entrega'] == 'domicilio' ? 'selected' : '' ?>>Domicilio</option>
                    <option value="recogida" <?= $preOrden['metodo_entrega'] == 'recogida' ? 'selected' : '' ?>>Recogida</option>
                </select>
            </div>

            <!-- Fecha de Entrega -->
            <div class="mb-3">
                <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?= $preOrden['fecha_entrega'] ?>" required>
            </div>

            <!-- Método de Pago -->
            <div class="mb-3">
                <label for="metodo_pago" class="form-label">Método de Pago</label>
                <select class="form-control" id="metodo_pago" name="metodo_pago" required>
                    <option value="tarjeta" <?= $preOrden['metodo_pago'] == 'tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
                    <option value="efectivo" <?= $preOrden['metodo_pago'] == 'efectivo' ? 'selected' : '' ?>>Efectivo</option>
                    <option value="transferencia" <?= $preOrden['metodo_pago'] == 'transferencia' ? 'selected' : '' ?>>Transferencia</option>
                </select>
            </div>
            <!-- Información solo visible, pero no modificable -->
            <div class="mb-3">
                <label for="valor_total" class="form-label">Valor Total</label>
                <input type="number" class="form-control" id="valor_total" name="valor_total" value="<?= $preOrden['valor_total'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="descuento" class="form-label">Descuento</label>
                <input type="number" class="form-control" id="descuento" name="descuento" value="<?= $preOrden['descuento'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="impuesto" class="form-label">Impuesto</label>
                <input type="number" class="form-control" id="impuesto" name="impuesto" value="<?= $preOrden['impuesto'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="abono" class="form-label">Abono</label>
                <input type="number" class="form-control" id="abono" name="abono" value="<?= $preOrden['abono'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="id_cliente" class="form-label">ID Cliente</label>
                <input type="number" class="form-control" id="id_cliente" name="id_cliente" value="<?= $preOrden['id_cliente_realiza'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="id_logistica" class="form-label">ID Logística</label>
                <input type="number" class="form-control" id="id_logistica" name="id_logistica" value="<?= $preOrden['id_logistica_alista'] ?>" readonly>
            </div>

            <!-- Productos Existentes en la Pre-Orden -->
            <h3>Productos Existentes</h3>
            <?php foreach ($productosPreorden as $index => $producto): ?>
                <div class="mb-3">
                    <label>Producto:</label>
                    <input type="text" class="form-control" value="<?= $producto['nombre_producto'] ?>" readonly>
                    <input type="hidden" name="producto_id[]" value="<?= $producto['id_producto'] ?>">

                    <label>Cantidad:</label>
                    <input type="number" class="form-control" name="cantidad[]" value="<?= $producto['cantidad'] ?>" min="1" required>

                    <label>Precio:</label>
                    <input type="number" class="form-control" name="precio[]" value="<?= $producto['precio'] ?>" readonly>

                    <!-- Checkbox para eliminar productos -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="eliminar_producto_id[]" value="<?= $producto['id_producto'] ?>">
                        <label class="form-check-label">Eliminar este producto</label>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Agregar Nuevos Productos -->
            <h3>Agregar Nuevos Productos</h3>
            <div id="nuevo-producto-container"></div>
            <button type="button" class="btn btn-secondary" onclick="agregarNuevoProducto()">Añadir Producto</button>

            <br><br>
            <button type="submit" class="btn btn-primary">Actualizar Pre-Orden</button>
        </form>
    </div>

    <script>
        // Función para añadir un nuevo producto dinámicamente
        function agregarNuevoProducto() {
            const contenedor = document.getElementById('nuevo-producto-container');
            const nuevoProductoHTML = `
                <div class="mb-3">
                    <label>Nuevo Producto:</label>
                    <select class="form-control" name="nuevo_producto_id[]">
                        <?php foreach ($todosLosProductos as $producto): ?>
                            <option value="<?= $producto['id'] ?>"><?= $producto['nombre_producto'] ?> - Precio: <?= $producto['valor'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Cantidad:</label>
                    <input type="number" class="form-control" name="nueva_cantidad[]" value="1" min="1" required>
                </div>`;
            contenedor.insertAdjacentHTML('beforeend', nuevoProductoHTML);
        }
    </script>
</body>
</html>
