<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar y limpiar los datos de entrada aquí

    // Datos del usuario
    $nombreUsuario = $_POST['NombreUsuario'] ?? '';
    $correoElectronico = $_POST['CorreoElectronico'] ?? '';
    $contrasena = $_POST['Contrasena'] ?? ''; 
    $idRol = intval($_POST['IdRol'] ?? 0);

    // Datos del cliente
    $nombre = $_POST['Nombre'] ?? '';
    $apellido = $_POST['Apellido'] ?? '';
    $sexo = $_POST['Sexo'] ?? '';
    $fechaNacimiento = $_POST['FechaNacimiento'] ?? '';
    $telefono = $_POST['Telefono'] ?? '';
    $dni = intval($_POST['Dni'] ?? 1);

    // Datos de la dirección
    $departamento = $_POST['Departamento'] ?? '';
    $provincia = $_POST['Provincia'] ?? '';
    $distrito = $_POST['Distrito'] ?? '';
    $direccion = $_POST['Direccion'] ?? '';

    $obj = new Conectar();
    $conexion = $obj->getConexion();

    try {
        // Iniciar una transacción
        $conexion->begin_transaction();

        // Codificación de la contraseña
        $contrasenaCodificada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar nuevo usuario
        $sqlUsuario = "INSERT INTO usuario (NombreUsuario, CorreoElectronico, Contrasena, IdRol) VALUES (?, ?, ?, ?)";
        $stmtUsuario = $conexion->prepare($sqlUsuario);
        $stmtUsuario->bind_param("sssi", $nombreUsuario, $correoElectronico, $contrasenaCodificada, $idRol);
        $stmtUsuario->execute();
        $idUsuario = $conexion->insert_id;
        $stmtUsuario->close();

        // Insertar nuevo cliente
        $sqlCliente = "INSERT INTO cliente (IdUsuario, Nombre, Apellido, Sexo, FechaNacimiento, Telefono, Dni) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtCliente = $conexion->prepare($sqlCliente);
        $stmtCliente->bind_param("isssssi", $idUsuario, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $dni);
        $stmtCliente->execute();
        $idCliente = $conexion->insert_id;
        $stmtCliente->close();

        // Insertar nueva dirección
        $sqlDireccion = "INSERT INTO direccion (IdCliente, Departamento, Provincia, Distrito, Direccion) VALUES (?, ?, ?, ?, ?)";
        $stmtDireccion = $conexion->prepare($sqlDireccion);
        $stmtDireccion->bind_param("issss", $idCliente, $departamento, $provincia, $distrito, $direccion);
        $stmtDireccion->execute();
        $stmtDireccion->close();

        // Confirmar la transacción
        $conexion->commit();
        $obj->closeConexion();
        header("Location: clientes.php");
        exit();
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conexion->rollback();
        echo "Error en la base de datos: " . $e->getMessage();
    }

    $obj->closeConexion();
} else {
    echo "Solicitud no válida.";
}
?>
