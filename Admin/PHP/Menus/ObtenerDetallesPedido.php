<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if (isset($_GET['idPedido'])) {
    $idPedido = $_GET['idPedido'];
    $obj = new Conectar();
    $conn = $obj->getConexion();

    $sql = "SELECT SUM(Cantidad * PrecioUnitario) AS subtotal, SUM(Descuento) AS descuento FROM detallepedido WHERE IdPedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPedido);
    $stmt->execute();
    $stmt->bind_result($subtotal, $descuento);
    $stmt->fetch();
    $stmt->close();

    if ($subtotal !== null && $descuento !== null) {
        $igv = 18; // Se puede obtener dinámicamente si se desea
        $total = ($subtotal - $descuento) * (1 + ($igv / 100));
        echo json_encode(['success' => true, 'descuento' => $descuento, 'total' => $total]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
