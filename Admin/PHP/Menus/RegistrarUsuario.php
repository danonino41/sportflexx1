<?php
require_once(__DIR__ . "/../coneccion/conector.php");

if (isset($_POST['btnRegistrar'])) {
    // Validar que todos los campos requeridos estén presentes
    $requiredFields = [
        'NombreUsuario', 'CorreoElectronico', 'Contrasena', 
        'Nombre', 'Apellido', 'Sexo', 'FechaNacimiento', 
        'Telefono', 'Dni', 'Departamento', 'Provincia', 
        'Distrito', 'Direccion'
    ];
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo "Por favor, complete todos los campos.";
            exit();
        }
    }

    // Recoger datos del formulario
    $nombreUsuario = $_POST['NombreUsuario'];
    $correoElectronico = $_POST['CorreoElectronico'];
    $contrasena = password_hash($_POST['Contrasena'], PASSWORD_DEFAULT);
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $sexo = $_POST['Sexo'];
    $fechaNacimiento = $_POST['FechaNacimiento'];
    $telefono = $_POST['Telefono'];
    $dni = $_POST['Dni'];
    $departamento = $_POST['Departamento'];
    $provincia = $_POST['Provincia'];
    $distrito = $_POST['Distrito'];
    $direccion = $_POST['Direccion'];

    $obj = new Conectar();
    $conexion = $obj->getConexion();

    // Iniciar la transacción
    $conexion->begin_transaction();

    try {
        // Insertar en la tabla usuario
        $stmt = $conexion->prepare("INSERT INTO usuario (NombreUsuario, CorreoElectronico, Contrasena, IdRol) VALUES (?, ?, ?, 2)");
        $stmt->bind_param("sss", $nombreUsuario, $correoElectronico, $contrasena);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en la tabla usuario: " . $stmt->error);
        }
        $idUsuario = $conexion->insert_id;
        $stmt->close();

        // Insertar en la tabla cliente
        $stmt = $conexion->prepare("INSERT INTO cliente (IdUsuario, Nombre, Apellido, Sexo, FechaNacimiento, Telefono, Dni) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $idUsuario, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $dni);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en la tabla cliente: " . $stmt->error);
        }
        $idCliente = $conexion->insert_id;
        $stmt->close();

        // Insertar en la tabla dirección
        $stmt = $conexion->prepare("INSERT INTO direccion (IdCliente, Departamento, Provincia, Distrito, Direccion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $idCliente, $departamento, $provincia, $distrito, $direccion);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en la tabla dirección: " . $stmt->error);
        }
        $stmt->close();

        // Confirmar la transacción
        $conexion->commit();

        // Redirigir a la página de login después del registro exitoso
        header("Location: login2.php");
        exit();

    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        $conexion->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conexion->close();
}
?>
