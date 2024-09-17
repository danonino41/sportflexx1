<?php
session_start();
require_once(__DIR__ . "/../coneccion/conector.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Crear una instancia de la clase Conectar y obtener la conexión
$conectar = new Conectar();
$conexion = $conectar->getConexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnLogin'])) {
    if (empty($_POST["NombreUsuario"]) || empty($_POST["Contrasena"])) {
        $_SESSION['mensaje'] = "Los campos están vacíos";
        header("Location: ../../../Cliente/PHP/login2.php");
        exit();
    } else {
        $Usuario = $_POST["NombreUsuario"];
        $Contrasena = $_POST["Contrasena"];

        // Comprobar si el usuario está bloqueado y obtener sus intentos
        $stmt = $conexion->prepare("SELECT Bloqueado, Intentos, Contrasena, IdRol, IdUsuario FROM usuario WHERE NombreUsuario = ?");
        $stmt->bind_param("s", $Usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($user['Bloqueado'] == 1) {
                $_SESSION['mensaje'] = "Usuario bloqueado. Contacte al administrador.";
                header("Location: ../../../Cliente/PHP/login2.php");
                exit();
            }

            if ($user['Intentos'] == 0) {
                $stmt = $conexion->prepare("UPDATE usuario SET Bloqueado = 1 WHERE NombreUsuario = ?");
                $stmt->bind_param("s", $Usuario);
                $stmt->execute();
                $_SESSION['mensaje'] = "Usuario bloqueado por múltiples intentos fallidos.";
                header("Location: ../../../Cliente/PHP/login2.php");
                exit();
            }

            // Verificar las credenciales
            if (password_verify($Contrasena, $user['Contrasena'])) {
                $IdRol = $user['IdRol'];
                $IdUsuario = $user['IdUsuario'];

                // Establecer la sesión del usuario
                $_SESSION['IdUsuario'] = $IdUsuario;
                $_SESSION['idRol'] = $IdRol;

                // Reiniciar los intentos fallidos
                $stmt = $conexion->prepare("UPDATE usuario SET Intentos = 3 WHERE NombreUsuario = ?");
                $stmt->bind_param("s", $Usuario);
                $stmt->execute();

                // Añadir la limpieza del carrito de compras antes de redirigir al usuario
                echo "
                    <script>
                        // Limpiar el carrito de localStorage cuando el usuario inicia sesión correctamente
                        localStorage.removeItem('cart');
                    </script>
                ";

                // Redirigir según el rol del usuario
                if ($IdRol == 1) {
                    // Redirigir a la página de administrador
                    echo "<script>window.location.href = '../../../Admin/PHP/Menus/MenuAdmin.php';</script>";
                    exit();
                } else if ($IdRol == 2) {
                    // Redirigir a la página del cliente
                    echo "<script>window.location.href = '../../../Cliente/HTML/MenuPrincipalCliente.php';</script>";
                    exit();
                } else {
                    $_SESSION['mensaje'] = 'Rol desconocido';
                    header("Location: ../../../Cliente/PHP/login2.php");
                    exit();
                }
            } else {
                // Decrementar el contador de intentos fallidos
                $stmt = $conexion->prepare("UPDATE usuario SET Intentos = Intentos - 1 WHERE NombreUsuario = ?");
                $stmt->bind_param("s", $Usuario);
                $stmt->execute();

                // Obtener el número de intentos restantes después de la actualización
                $stmt = $conexion->prepare("SELECT Intentos FROM usuario WHERE NombreUsuario = ?");
                $stmt->bind_param("s", $Usuario);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $intentosRestantes = $user['Intentos'];

                if ($intentosRestantes > 0) {
                    $_SESSION['mensaje'] = "Usuario y/o claves incorrectos. Intentos restantes: " . $intentosRestantes;
                } else {
                    $_SESSION['mensaje'] = "Usuario bloqueado por múltiples intentos fallidos.";
                }

                header("Location: ../../../Cliente/PHP/login2.php");
                exit();
            }
        } else {
            $_SESSION['mensaje'] = "Usuario y/o claves incorrectos.";
            header("Location: ../../../Cliente/PHP/login2.php");
            exit();
        }
    }
}
?>
