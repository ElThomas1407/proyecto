<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.html");
    exit();
}

include 'PreordenM.php'; // Incluir la clase PreOrden

$preordenModel = new PreOrden(); // Instancia de la clase PreOrden

// Buscar preorden por ID si se envía la búsqueda
$preordenEspecifica = null;
if (isset($_GET['id_busqueda'])) {
    $idBusqueda = $_GET['id_busqueda'];
    $preordenEspecifica = $preordenModel->consultarPreOrdenPorIdActiva($idBusqueda); // Buscar preorden activa por ID
}

// Si se recibe una solicitud para eliminar (cambiar estado a inactivo)
if (isset($_GET['eliminar'])) {
    $idPreorden = $_GET['eliminar'];
    $preordenModel->eliminarPreorden($idPreorden); // Cambiar el estado de la preorden a 'inactivo'
    header("Location: eliminarPreorden.php?success=true");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Pre-Orden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'migaDePan.php'; ?>
    <div class="container mt-5">
        <h2>Eliminar Pre-Orden</h2>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
            <div class="alert alert-success" role="alert">
                La pre-orden se ha eliminado correctamente (cambiado a estado inactivo).
            </div>
        <?php endif; ?>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="eliminarPreorden.php" class="mb-4">
            <div class="input-group">
                <input type="number" class="form-control" name="id_busqueda" placeholder="Buscar por ID" min="1" value="<?= isset($idBusqueda) ? $idBusqueda : '' ?>">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <!-- Mostrar el resultado de la búsqueda -->
        <?php if ($preordenEspecifica): ?>
            <h3>Resultado de la Búsqueda</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha Solicitud</th>
                        <th>Destino</th>
                        <th>Método de Entrega</th>
                        <th>Fecha de Entrega</th>
                        <th>Valor Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $preordenEspecifica['id'] ?></td>
                        <td><?= $preordenEspecifica['fecha_solicitud'] ?></td>
                        <td><?= $preordenEspecifica['destino'] ?></td>
                        <td><?= $preordenEspecifica['metodo_entrega'] ?></td>
                        <td><?= $preordenEspecifica['fecha_entrega'] ?></td>
                        <td><?= $preordenEspecifica['valor_total'] ?></td>
                        <td>
                            <a href="eliminarPreorden.php?eliminar=<?= $preordenEspecifica['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta pre-orden?');">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php elseif (isset($idBusqueda)): ?>
            <div class="alert alert-danger" role="alert">
                No se encontró ninguna pre-orden con ese ID.
            </div>
        <?php endif; ?>

        <!-- Mostrar todas las preordenes activas solo si no se realiza una búsqueda -->
        <?php if (!isset($idBusqueda) || !$preordenEspecifica): ?>
            <?php if (!empty($preordenesActivas)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Solicitud</th>
                            <th>Destino</th>
                            <th>Método de Entrega</th>
                            <th>Fecha de Entrega</th>
                            <th>Valor Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($preordenesActivas as $preorden): ?>
                            <tr>
                                <td><?= $preorden['id'] ?></td>
                                <td><?= $preorden['fecha_solicitud'] ?></td>
                                <td><?= $preorden['destino'] ?></td>
                                <td><?= $preorden['metodo_entrega'] ?></td>
                                <td><?= $preorden['fecha_entrega'] ?></td>
                                <td><?= $preorden['valor_total'] ?></td>
                                <td>
                                    <!-- Botón para eliminar la preorden -->
                                    <a href="eliminarPreorden.php?eliminar=<?= $preorden['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta pre-orden?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay pre-ordenes activas.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
