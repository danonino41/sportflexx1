<?php
require_once(__DIR__ . '/../tcpdf/tcpdf.php');
require_once(__DIR__ . '/../coneccion/conector.php');

class PDF extends TCPDF {
    public function Header() {
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Ventas por Fecha', 0, 1, 'C');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];

    $obj = new Conectar();
    $sql = "SELECT v.IdVenta, c.Nombre AS Cliente, u.NombreUsuario AS Empleado, v.FechaVenta, v.Total
            FROM venta v
            JOIN pedido p ON v.IdPedido = p.IdPedido
            JOIN cliente c ON p.IdCliente = c.IdCliente
            JOIN usuario u ON c.IdUsuario = u.IdUsuario
            WHERE v.FechaVenta BETWEEN ? AND ?";
    $stmt = $obj->getConexion()->prepare($sql);
    $stmt->bind_param("ss", $fechaInicio, $fechaFinal);
    $stmt->execute();
    $result = $stmt->get_result();

    $pdf = new PDF();
    $pdf->SetFont('helvetica', '', 12);
    $pdf->AddPage();

    $html = '<table border="1" cellpadding="4">
                <thead>
                    <tr>
                        <th>Num. Boleta</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row['IdVenta'] . '</td>
                    <td>' . $row['Cliente'] . '</td>
                    <td>' . $row['Empleado'] . '</td>
                    <td>' . $row['FechaVenta'] . '</td>
                    <td>' . $row['Total'] . '</td>
                </tr>';
    }
    $html .= '</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('reporte_ventas.pdf', 'I');
}
?>
