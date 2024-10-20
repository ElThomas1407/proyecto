<?php
include 'PreordenM.php'; // Clase PreOrden

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_preorden'])) {
    $idPreorden = $_POST['id_preorden'];

    try {
        $preOrden = new PreOrden();
        $preOrden->autorizarVenta($idPreorden); // Llama a la función que ejecuta el procedimiento autorizar_venta_preorden

        // Redirigir de vuelta a la página de consulta de pre-ordenes con un mensaje de éxito
        header("Location: consultaventas.php?success=true");
    } catch (Exception $e) {
        // Manejar el error si la pre-orden ya ha sido autorizada
        header("Location: consultapreorden.php?error=" . urlencode($e->getMessage()));
    }
    exit();
}
