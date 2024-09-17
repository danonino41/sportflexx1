<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj = new Conectar();
    $IdProducto = $_POST["IdProducto"];
    $CodigoProducto = $_POST["CodigoProducto"];
    $Nombre = $_POST["Nombre"];
    $Descripcion = $_POST["Descripcion"];
    $Stock = $_POST["Stock"];
    $Talla = $_POST["Talla"];
    $Color = $_POST["Color"];
    $IdCategoria = $_POST["IdCategoria"];
    $PrecioUnitario = $_POST["PrecioUnitario"];
    $FechaRegistro = $_POST["FechaRegistro"];
    $Genero = $_POST["Genero"];

    $ImagenProducto = "";
    if (isset($_FILES['ImagenProducto']) && $_FILES['ImagenProducto']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["ImagenProducto"]["name"]);
        if (move_uploaded_file($_FILES["ImagenProducto"]["tmp_name"], $target_file)) {
            $ImagenProducto = $target_file;
        }
    }

    if ($IdProducto == 0) {
        $sql = "INSERT INTO producto (CodigoProducto, Nombre, Descripcion, Stock, Talla, Color, IdCategoria, PrecioUnitario, FechaRegistro, Genero, ImagenProducto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $obj->getConexion()->prepare($sql);
        $stmt->bind_param("sssississss", $CodigoProducto, $Nombre, $Descripcion, $Stock, $Talla, $Color, $IdCategoria, $PrecioUnitario, $FechaRegistro, $Genero, $ImagenProducto);
    } else {
        $sql = "UPDATE producto SET CodigoProducto = ?, Nombre = ?, Descripcion = ?, Stock = ?, Talla = ?, Color = ?, IdCategoria = ?, PrecioUnitario = ?, FechaRegistro = ?, Genero = ?, ImagenProducto = ? WHERE IdProducto = ?";
        $stmt = $obj->getConexion()->prepare($sql);
        $stmt->bind_param("sssississssi", $CodigoProducto, $Nombre, $Descripcion, $Stock, $Talla, $Color, $IdCategoria, $PrecioUnitario, $FechaRegistro, $Genero, $ImagenProducto, $IdProducto);
    }

    if ($stmt->execute()) {
        header("Location: Productos.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
