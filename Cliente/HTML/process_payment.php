<?php
require('../../fpdf/fpdf.php');
include('../../Admin/PHP/coneccion/conector.php');

function fetch_product_data($product_id) {
    return [
        'name' => 'Producto ' . $product_id,
        'description' => 'Descripción del producto ' . $product_id,
        'price' => 50.00,
    ];
}

function generate_invoice($cart) {
    $pdf = new FPDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Comprobante de Pago', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Nombre del Cliente: [Nombre]', 0, 1);
    $pdf->Cell(0, 10, 'Direccion: [Direccion]', 0, 1);
    $pdf->Cell(0, 10, 'Telefono: [Telefono]', 0, 1);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(80, 10, 'Producto', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(40, 10, 'Precio Unitario', 1);
    $pdf->Cell(40, 10, 'Total', 1);
    $pdf->Ln();

    $subtotal = 0;
    $igv_rate = 0.08;

    foreach ($cart as $item) {
        $product_data = fetch_product_data($item['id']);
        $product_total = $product_data['price'] * $item['cantidad'];
        $subtotal += $product_total;

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(80, 10, $product_data['name'], 1);
        $pdf->Cell(30, 10, $item['cantidad'], 1, 0, 'C');
        $pdf->Cell(40, 10, 'S/' . number_format($product_data['price'], 2), 1, 0, 'R');
        $pdf->Cell(40, 10, 'S/' . number_format($product_total, 2), 1, 0, 'R');
        $pdf->Ln();
    }

    $igv = $subtotal * $igv_rate;
    $total = $subtotal + $igv;

    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, 10, 'Subtotal', 1);
    $pdf->Cell(40, 10, 'S/' . number_format($subtotal, 2), 1, 0, 'R');
    $pdf->Ln();
    $pdf->Cell(150, 10, 'IGV (8%)', 1);
    $pdf->Cell(40, 10, 'S/' . number_format($igv, 2), 1, 0, 'R');
    $pdf->Ln();
    $pdf->Cell(150, 10, 'Total', 1);
    $pdf->Cell(40, 10, 'S/' . number_format($total, 2), 1, 0, 'R');

    $filename = 'comprobante_' . time() . '.pdf';
    $pdf->Output('F', $filename);

    return $filename;
}

$data = json_decode(file_get_contents('php://input'), true);

// Agregar registros de depuración
error_log("Datos JSON recibidos: " . file_get_contents('php://input'));
error_log("Datos decodificados: " . print_r($data, true));

if ($data && isset($data['cart'])) {
    $cart = $data['cart'];

    // Generar el comprobante de pago
    $pdfUrl = generate_invoice($cart);

    $response = [
        'success' => true,
        'pdfUrl' => $pdfUrl
    ];
} else {
    error_log("Datos inválidos recibidos.");
    $response = [
        'success' => false,
        'message' => 'Datos inválidos recibidos'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
