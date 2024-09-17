<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if (isset($_GET['idVenta'])) {
    $idVenta = $_GET['idVenta'];
    $obj = new Conectar();
    $sqlVenta = "SELECT v.IdVenta, p.NumeroPedido, c.Nombre AS Cliente, c.Apellido, v.FechaVenta, v.IGV, v.Total, v.Descuento, tp.Tipo AS TipoPago, d.Direccion
                 FROM venta v
                 JOIN pedido p ON v.IdPedido = p.IdPedido
                 JOIN cliente c ON p.IdCliente = c.IdCliente
                 JOIN tipopago tp ON v.IdTipoPago = tp.IdTipoPago
                 JOIN direccion d ON c.IdCliente = d.IdCliente
                 WHERE v.IdVenta = ?";
    $stmtVenta = $obj->getConexion()->prepare($sqlVenta);
    $stmtVenta->bind_param("i", $idVenta);
    $stmtVenta->execute();
    $venta = $stmtVenta->get_result()->fetch_assoc();

    $sqlDetalle = "SELECT dp.Cantidad, dp.PrecioUnitario, dp.Descuento, pr.Nombre AS Producto
                   FROM detallepedido dp
                   JOIN producto pr ON dp.IdProducto = pr.IdProducto
                   WHERE dp.IdPedido = ?";
    $stmtDetalle = $obj->getConexion()->prepare($sqlDetalle);
    $stmtDetalle->bind_param("i", $venta['NumeroPedido']);
    $stmtDetalle->execute();
    $detalles = $stmtDetalle->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .header, .footer {
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .details {
            margin-top: 20px;
        }
        .details table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .details th, .details td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .details th {
            background-color: #f8f8f8;
        }
        .totals {
            margin-top: 20px;
            text-align: right;
        }
        .totals p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="path/to/logo.png" alt="Logo">
            <h2>SPORTFLEXX</h2>
            <p>RUC N° 20513836130</p>
            <h3>BOLETA DE VENTA</h3>
            <p>002 - 0000127</p>
        </div>
        
        <?php if ($venta): ?>
            <div class="details">
                <p><strong>Cliente:</strong> <?= $venta['Cliente'] . " " . $venta['Apellido'] ?></p>
                <p><strong>Número de Pedido:</strong> <?= $venta['NumeroPedido'] ?></p>
                <p><strong>Fecha de Venta:</strong> <?= $venta['FechaVenta'] ?></p>
                <p><strong>Tipo de Pago:</strong> <?= $venta['TipoPago'] ?></p>
                <p><strong>Dirección:</strong> <?= $venta['Direccion'] ?></p>
                
                <h5>Detalles de los Productos</h5>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Descuento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($detalle = $detalles->fetch_assoc()): ?>
                            <tr>
                                <td><?= $detalle['Producto'] ?></td>
                                <td><?= $detalle['Cantidad'] ?></td>
                                <td>S/ <?= $detalle['PrecioUnitario'] ?></td>
                                <td>S/ <?= $detalle['Descuento'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                
                <div class="totals">
                    <p><strong>IGV:</strong> <?= $venta['IGV'] ?>%</p>
                    <p><strong>Descuento (Cupón):</strong> <?= $venta['Descuento'] ?>%</p>
                    <p><strong>Total:</strong> S/ <?= $venta['Total'] ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>Venta no encontrada.</p>
        <?php endif; ?>

        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
